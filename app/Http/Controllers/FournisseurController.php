<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Auth;
use App\User;
use Validator;
use Hash;
use App\fournisseur;
use App\employeur;
use App\produit;
use App\categorie;
use DB;
class FournisseurController extends Controller
{
	public function Fournisseur()
    {
        $supplier=User::where('role','=',2)->paginate(20);
        $fournisseur=fournisseur::all();
        return view('dashboard.Liste_Fournisseur')->with(
            array(
                'supplier' => $supplier,
                'fournisseur'=>$fournisseur,
            )
        );
    }

    public function destroy(Request $request){
        $data=$request->all();
        /*****Si le compte est un compte de fournisseur supprimer le compte et le fournisseur */
        if($data['type'] == "fournisseur"){
            $supplier=User::find($data['id']);
            $supplier->delete();
            $table_fournisseur=fournisseur::where('id_user','=',$data['id'])->get();
            foreach ($table_fournisseur as $tf) {
                $tf->delete();
            }
            
        }
        /**Si le compte est un employeur supprimer le compte et modifier l'employeur avec id_user=0 */
        if($data['type']== "employeur"){
            /***Effacer le compte de l'employeur */
            $employeur=employeur::where('id_user','=',$data['id'])->first();
            $employeur->id_user=0;
            $employeur->update();
            /***Effacer le compte */
            $user=User::find($data['id']);
            $user->delete();
        }

        return redirect('/Compte')->with('flash_message_success','Compte supprimé');
        
    }


    public function add_supplier(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'tel'=>'required|unique:users',
            'cin'=>'required|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
        
        if( $request->hasFile('photo')){
            $filename=$request->photo->getClientOriginalName();
            $request->photo->move(public_path(). '/img',$filename);

        $supplier=new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'photo' =>$filename,
            'role' => '2',
            'tel' => $request->tel,
            'cin' => $request->cin,
            
        ]);
        $supplier->save();
        $last_user=User::latest()->first();
        $fournisseur=new fournisseur([
        	'matricule' => $request->matricule,
        	'region' => $request->region,
        	'ville' => $request->ville,
        	'postal' => $request->postal,
        	'adresse' => $request->adresse,
        	'id_user' => $last_user->id,
            'pass'=>$request->password,
        ]);
        $fournisseur->save();
            return redirect('/Liste_Fournisseur')->with('success','Fournisseur ajouté avec succés');
        }
    }


    public function search(Request $request){
        $name=$request->get('recherche');
        $supplier=User::where('name','like','%'.$name.'%')->get();
        if ($supplier != NULL) {
            return view('dashboard.Liste_Fournisseur')->with(
            array(
                'supplier' => $supplier,
            )
         );
        }
        else{
            return redirect('/Liste_Fournisseur')->with('flash_message_success',"Fournisseur n'est pas là  ");
        }
        
    }
}
