<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\employeur;
use App\presence;
use Auth;
use App\conges;

class EmployeurController extends Controller
{
    /**employeur**/
    public function index(){
    	$employeur=employeur::paginate(20);
    	return view('dashboard.employeur.employeur')->with(array(
    		'employeur'=>$employeur,
    	));
    }

    public function AddEmployer(Request $request){
    	
    	if ($request->email != "" && $request->password != "") {
    		$this->validate($request, [
            'nom' => 'required',
            'email' => 'email|unique:users',
            'tel'=>'required|unique:users',
            'cin'=>'required|unique:users',
            'password' => 'min:6|confirmed',
            ]);
        
            if( $request->hasFile('photo')){
                $filename=$request->photo->getClientOriginalName();
                $request->photo->move(public_path(). '/img',$filename);

            $user=new User([
                'name' => $request->nom,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'photo' =>$filename,
                'role' => '3',
                'tel' => $request->tel,
                'cin' => $request->cin,
                
            ]);
            $user->save();
            $last_user=User::latest()->first();
            $employeur=new employeur([
                'nom' => $request->nom,
                'image' =>$filename,
                'tel' => $request->tel,
                'cin' => $request->cin,
                'adresse' => $request->adresse,
                'salaire' => $request->salaire,
                'id_user' => $last_user->id,
                'password'=>$request->password,
            ]);
            $employeur->save();
                return redirect('/Employeur')->with('success','Employeur ajouté avec succés');
            }
    	}else{
            if( $request->hasFile('photo')){
            $filename=$request->photo->getClientOriginalName();
            $request->photo->move(public_path(). '/img',$filename);
            $employeur=new employeur([
                'nom' => $request->nom,
                'image' =>$filename,
                'tel' => $request->tel,
                'cin' => $request->cin,
                'adresse' => $request->adresse,
                'salaire' => $request->salaire,
                'id_user' => 0,
                'password'=>"",
            ]);
            $employeur->save();
                return redirect('/Employeur')->with('success','Employeur ajouté avec succés');
            }
    	}
    }


    public function Destroy(Request $request){
    	$id=$request->get('employeur');
    	$emp=employeur::find($id);
    	if ($emp->id_user > 0) {
    		$user=User::find($emp->id_user);
    		$user->delete();
    	}
    	$emp->delete();
    	return back()->with('flash_message_success',"L'employeur est supprimé");
    }

    public function UpdateEmployer(Request $request,$id){
        if($request->isMethod('post')){
            $employeur=employeur::find($id);
        if ($request->id_user==1) {
            $this->validate($request, [
            'nom' => 'required',
            //'email' => 'email|unique:users',
            //'tel'=>'required|unique:users',
           // 'cin'=>'required|unique:users',
            'password' => 'min:6|confirmed',
        ]);
        
        
            //if l emplye déjà user alors update user else ajouter un nouveau utilisateur
            if($employeur->id_user > 0){
                $user=User::find($employeur->id_user);
                $user->name=$request->nom;
                $user->email=$request->email;
                $user->password=bcrypt($request->password);
                if( $request->hasFile('photo')){
                    ///Nfass5ou limage le9dima m doussi 
                $filename=$request->photo->getClientOriginalName();
                $request->photo->move(public_path(). '/img',$filename);

                $user->photo=$filename;
                }
                $user->role=3;
                $user->tel=$request->tel;
                $user->cin=$request->cin;
                $user->update();
            }else{
                $user=new User();
                $user->name=$request->nom;
                $user->email=$request->email;
                $user->password=bcrypt($request->password);
                if( $request->hasFile('photo')){ 
                $filename=$request->photo->getClientOriginalName();
                $request->photo->move(public_path(). '/img',$filename);

                $user->photo=$filename;
                }else{
                    $user->photo=$employeur->image;
                }
                $user->role=3;
                $user->tel=$request->tel;
                $user->cin=$request->cin;
                $user->save();

            }
            
        //Update employeur
            $last_user=User::latest()->first();
            $employeur=employeur::find($id);
            $employeur->nom = $request->nom;
            if( $request->hasFile('photo')){
                    ///Nfass5ou limage le9dima m doussi 
                $filename=$request->photo->getClientOriginalName();
                $request->photo->move(public_path(). '/img',$filename);
            $employeur->image = $filename;
            }
            $employeur->tel = $request->tel;
            $employeur->cin = $request->cin;
            $employeur->adresse = $request->adresse;
            $employeur->salaire = $request->salaire;
            $employeur->id_user = $last_user->id;
            $employeur->password= $request->password;
        
            $employeur->update();
            return redirect('/Employeur')->with('success','Employeur modifié avec succés');
        
        }else{
            $employeur=employeur::find($id);
            //Effacer compte employeur si il est existe
            if ($employeur->id_user > 0) {
                $user=User::find($employeur->id_user);
                $user->delete();
            }
            $employeur->nom = $request->nom;
            if( $request->hasFile('photo')){
                    ///Nfass5ou limage le9dima m doussi 
                $filename=$request->photo->getClientOriginalName();
                $request->photo->move(public_path(). '/img',$filename);
            $employeur->image = $filename;
            }
            $employeur->tel = $request->tel;
            $employeur->cin = $request->cin;
            $employeur->adresse = $request->adresse;
            $employeur->salaire = $request->salaire;
            $employeur->id_user = 0;
            $employeur->password="";
        
            $employeur->update();
            
            
            return redirect('/Employeur')->with('success','Employeur modifié avec succés');
        }
        }else{
            $employeur=employeur::find($id);
            if ($employeur->id_user != 0) {
                $user=User::find($employeur->id_user);
            }else{
                $user=NULL;
            }
            return view('dashboard.employeur.UpdateEmployer')->with(array(
                'employeur'=>$employeur,
                'user'=>$user,
            ));
        }
    }

    public function SearchEmployer(Request $request){
        $nom=$request->get('nom');
        $employeur=employeur::where('nom','like','%'.$nom.'%')->get();
        return view('dashboard.employeur.employeur')->with(array(
            'employeur'=>$employeur,
        ));
    }

    /***Présence**/
    public function presence(){
        $employeur=employeur::all();
        $num=employeur::all()->count();
        $presence=presence::orderBy('date','desc')->paginate($num);
        return view('dashboard.employeur.presence')->with(array(
            'employeur'=>$employeur,
            'presence'=>$presence,
        ));
    }


    public function Addpresence(Request $request){
        $data=$request->all();
        $this->validate($request, [
            'id_emp' => 'required',
            'date' => 'required',
        ]);
        $employeur=employeur::find($data['id_emp']);
        $presence=new presence();
        $presence->date=$data['date'];
        if ($data['arrive'] == NULL){
            $presence->statut="Abssent(e)";
            $presence->enregistrement="00:00";
            $presence->verifier="00:00";
        }else{
            $presence->statut="Présent(e)";
            $presence->enregistrement=$data['arrive'];
            $presence->verifier=$data['sort'];
        }
        
        $presence->emp_id=$data['id_emp'];
        $presence->employeur=$employeur->nom;
        $presence->responsable=Auth::user()->name;
        $presence->save();
        return back()->with('flash_message_success','Présence ajouter');
    }

    public function destroyPresence(Request $request){
        $id=$request->get('present_id');
        $presence=presence::find($id);
        $presence->delete();
        return back()->with('flash_message_success','La présence est supprimé');
    }

    public function Searchpresent(Request $request){
        $name=$request->get('recherche');
        $employeur=employeur::all();
        $num=employeur::all()->count();
        $presence=presence::where('employeur','like','%'.$name.'%')->paginate($num);
        return view('dashboard.employeur.presence')->with(compact('presence','employeur'));
    }

    public function UpdatePresence(Request $request){
        $data=$request->all();
        $presence=presence::find($data['id']);
        $presence->enregistrement=$data['arrive'];
        $presence->verifier=$data['sort'];
        $presence->update();
        return back()->with('flash_message_success','Temps modifié');
    }

    public function SearchPresentWithDate(Request $request){
        $date=$request->get('date');
        $employeur=employeur::all();
        $num=employeur::all()->count();
        $presence=presence::where('date','=',$date)->paginate($num);
        return view('dashboard.employeur.presence')->with(compact('presence','employeur')); 
    }

    /***Congés**/
    public function Vacance(){
        $vacance=conges::paginate(20);
        $employeur=employeur::all();
        return view('dashboard.employeur.vacance')->with(array(
            'vacance'=>$vacance,
            'employeur'=>$employeur,
        ));
    }

    public function AddVacance(Request $request){
        $data=$request->all();
        $employeur=employeur::find($data['id_emp']);
        $vacance=new conges();
        $vacance->date=$data['date'];
        $vacance->emp_nom=$employeur->nom;
        $vacance->emp_id=$data['id_emp'];
        $vacance->de=$data['de'];
        $vacance->a=$data['a'];
        $vacance->note=$data['note'];
        $vacance->save();
        return redirect('/Congés');
    }

    public function destroyVacance(Request $request){
         $id=$request->get('vacance_id');
         $vacance=conges::find($id);
         $name=$vacance->emp_nom;
         $vacance->delete();
         return back()->with('flash_message_success','Le congée de '.$name.' est supprimé');
    }

    public function SearchVacanceWithName(Request $request){
        $nom=$request->get('recherche');
        $vacance=conges::where('emp_nom','like','%'.$nom.'%')->get();
        $employeur=employeur::all();
        return view('dashboard.employeur.vacance')->with(array(
            'vacance'=>$vacance,
            'employeur'=>$employeur,
        ));
    }

    public function SearchVacanceWithMonth(Request $request){
        $month=$request->get('month');
        $vacance=conges::whereMonth('date','=',$month)->get();
        $employeur=employeur::all();
        return view('dashboard.employeur.vacance')->with(array(
            'vacance'=>$vacance,
            'employeur'=>$employeur,
        ));
    }

    public function UpdateVacance(Request $request){
        $data=$request->all();
        $vacance=conges::find($data['id']);
        $vacance->date=$data['date'];
        $vacance->de=$data['de'];
        $vacance->a=$data['a'];
        $vacance->note=$data['note'];
        $vacance->update();
        return back()->with('flash_message_success','Le congé est bien modifié');
    }
}
