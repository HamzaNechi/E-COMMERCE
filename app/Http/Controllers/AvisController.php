<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\avis;
use App\produit;


class AvisController extends Controller
{
    
    public function Add_Avis(Request $request){
        $data=$request->all();
        $avis=new avis();
        $today = date("Y-m-d");
        $avis->note=$data['note'];
        $avis->nom=$data['nom'];
        $avis->email=$data['email'];
        $avis->etoile=$data['etoile'];
        $avis->id_produit=$data['id_produit'];
        $avis->date=$today;
        $avis->save();
        return back()->with('flash_message_success','Merci pour votre avis');
    }


    public function Get_Avis(){
        $avis=avis::orderBy('id','DESC')->paginate(20);
        $produit=produit::all();
        return view('dashboard.avis')->with(compact('avis','produit'));
    }


    public function destroy(Request $request){
        $id=$request->get('avis');
        $avis=avis::find($id);
        $avis->delete();
        return back()->with('flash_message_success',"L'avis est supprimer avec succés");
    }


    public function Sort_Avis_With_Product(Request $request){
        $avis=avis::where('id_produit','=',$request->id_produit)->paginate(20);
        $produit=produit::all();
        return view('dashboard.avis')->with(compact('avis','produit'));
    }


    public function Delete_All_Selected(Request $request){
        $data=$request->all();
        if ($data == NULL) {
            return back()->with('flash_message_error','Sélectionnez les avis a supprimé');
        }
        foreach ($data['all'] as $tous => $val) {
            $avis=avis::find($val);
            $avis->delete();
        }
        return back()->with('flash_message_success','La suppression est effectué');
    }


    /***Changer le statut d'avis*****/
    public function Modifier_Statut($val,$id){
       $avis=avis::find($id);
       $avis->status=$val;
       $avis->update();
       return back();
    }
}
