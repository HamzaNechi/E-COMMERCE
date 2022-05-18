<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Auth;
use App\User;
use App\fournisseur;
use App\employeur;
use Validator;
use Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function compte(){
        $user=User::paginate(20);
        $fournisseur=fournisseur::all();
        $employeur=employeur::all();
        return view('dashboard.compte')->with(array(
            'user'=>$user,
            'employeur'=>$employeur,
            'fournisseur'=>$fournisseur,
        ));
    }

    


    public function update(Request $request,$id){
        $supplier=User::find($id);
        if ($request->image != $supplier->photo) {
            if ($request->hasFile('photo')) {
            $filename=$request->photo->getClientOriginalName();
            $request->photo->move(public_path(). '/img',$filename);
            $supplier->photo=$filename;
            }
        }
        $supplier->name=$request->name;
        $supplier->tel=$request->tel;
        /****Modification adresse fournisseur */
        if(Auth::user()->role == 2){
            $fournisseur=fournisseur::where('id_user','=',$id)->first();
            $fournisseur->region = $request->region;
            $fournisseur->ville = $request->ville;
            $fournisseur->adresse = $request->adresse;
            $fournisseur->postal = $request->postal;
            $fournisseur->update();
        }
        $supplier->update();
        /*****Modification adresse fournisseur */
        return back()->with('flash_message_success','Profile modifié');
    }

    public function search(Request $request){
        $name=$request->get('recherche');
        $user=User::where('name','like','%'.$name.'%')->get();
        $fournisseur=fournisseur::all();
        $employeur=employeur::all();
        if ($user != NULL) {
            return view('dashboard.compte')->with(
            array(
                'user' => $user,
                'fournisseur' => $fournisseur,
                'employeur' => $employeur,
            )
         );
        }
        else{
            return redirect('/Liste_Fournisseur')->with('data not found');
        }
        
    }

    public function updatepassword(Request $request){
        $id=$request->user_id;
        $supplier=User::find($id);
        if ($request->new != "") {
            if(Hash::check($request->old,$supplier->password)){
            $new=Hash::make($request->new);
            $supplier->password=$new;
            }else{
                return redirect('/logout');
            }
        }
        $supplier->update();
        return back();
    }


    /****Retourner le fournisseur a la page profile */
    public function modifierprofile(){
        $id=Auth::user()->id;
        $fournisseur=fournisseur::where('id_user','=',$id)->first();
        return view('dashboard.profile')->with(compact('fournisseur'));
    }

    /*****Marquer la notification comme notification lu*****/
    public function markAsReadNotifications(){
        $id=Auth::user()->id;
        $admin=User::find($id);
        $admin->unreadNotifications->markAsRead();
    }
}
