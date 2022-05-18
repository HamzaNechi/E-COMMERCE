<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\produit;
use App\pack_produit;
use App\categorie;
use App\cart;
use Session;

class PackStandardController extends Controller
{
	//Ajouter les produits dans un pack avec la session
    public function AddProductInPAck(Request $request){
    	$session_id=Session::get('session_id');
	    if (empty($session_id)) {
	      $session_id=str_random(40);
	      Session::put('session_id',$session_id);
	    }
        $data=$request->all();
        if($data['prod_couleur'] != NULL){
            $couleur=$data['prod_couleur'];
        }else{
            $couleur="";
        }
        $pack=new pack_produit();
        $pack->id_pack=0;
        $pack->nom_produit=$data['prod_nom'];
        $pack->code_produit=$data['prod_code'];
        $pack->qty=$data['qty'];
        $pack->couleur=$couleur;
        $pack->session_id=$session_id;
        $pack->prod_id=$data['prod_id'];
        if ($data['taille'] == 0) {
        	$pack->prod_taille=0;
        	$pack->prix=$data['prod_prix'];
        }else{
        	$sizeArr=explode("-", $data['taille']);
        	$pack->prod_taille=$sizeArr[1];
        	$pack->prix=$sizeArr[0];
        }
        $pack->photo=$data['photo'];
        $pack->save();
        return back();
    }

    //Afficher les packs dans le dashboard
    public function VoirPackStandard(){
    	$pack=produit::where('type','=',"pack")->paginate(20);
    	$product=NULL;
    	return view('dashboard.produit')->with(compact('pack','product'));
    }

    //Afficher les détail de la pack dans le dashboard
    public function VoirDetailPackStandard($id){
    	$pack=produit::find($id);
    	$produit_pack=pack_produit::where('id_pack','=',$id)->get();
    	$produit=produit::where('cat_id','>',0)->get();
    	$attribute=NULL;
    	$detail=NULL;
    	return view('dashboard.detailproduit')->with(compact('pack','produit_pack','detail','attribute','produit'));
    }

    //Supprimer produit de la pack
    public function SupprimerProduit(Request $request){
        
        
    	$id=$request->get('prod_pack');
    	$produit=pack_produit::find($id);
        /***Tester si le pack a 2 produit alors supprimer le produit si non retourner message d'erreur */
        $id_pack=$produit->id_pack;
        $countproduct=pack_produit::where('id_pack','=',$id_pack)->sum('qty');
        if(($countproduct-$produit->qty) >= 2){
            $produit->delete();
    	    return back()->with('flash_message_success','Le produit est supprimé');
        }else{
            return back()->with('flash_message_error','Il faut que le minimum produit dans le pack est égale à 2.');
        }

    	
    }

    //Supprimer produit de la pack (page ajouter pack)
    public function DeleteProduct($id){
        $produit=pack_produit::find($id);
        $produit->delete();
        return back()->with('flash_message_success','Le produit est supprimé avec succés');
    }


    //Ajouter produit dans la modification de pack
    public function AddproductInEditPack(Request $request){
    	$data=$request->all();
        /*$data=json_decode(json_encode($data));
        echo "<pre>";print_r($data);die;*/
    	$pack=new pack_produit();
        $pack->id_pack=$data['id_pack'];
        $pack->nom_produit=$data['prod_nom'];
        $pack->code_produit=$data['prod_code'];
        $pack->qty=$data['qty'];
        $pack->couleur=$data['prod_couleur'];
        $pack->prod_id=$data['prod_id'];
        if ($data['taille'] == 0) {
            $pack->prod_taille=0;
            $pack->prix=$data['prod_prix'];
        }else{
            $sizeArr=explode("-", $data['taille']);
            $pack->prod_taille=$sizeArr[1];
            $pack->prix=$sizeArr[0];
        }
        $pack->photo=$data['photo'];
        $pack->session_id="";
        $pack->save();
        return back()->with('flash_message_success','Produit ajouté avec succés');
    }



    /*****************Pack personnaliséé******************/


    //Get les catégories à la page pack personnalisé vitrine
    public function Get_Catégorie(){
        $categories=categorie::where('parent_id','=',0)->get();
        return view('vitrine.packclient')->with(compact('categories'));
    }


    //Ajouter les produits du pack au panier
    public function Ajouter_Pack_Au_Panier(Request $request){
        $session_id=Session::get('session_id');
        if (empty($session_id)) {
            $session_id=str_random(40);
            Session::put('session_id',$session_id);
        }
        $data = $request->all();
        $prix=0;
        foreach($data['products'] as $prod => $value)
            $prix+=produit::where('id',$value)->first()->prix;
            $shopcart = new cart([
                'prod_id' => $request->products[0],
                'prod_nom' => 'Pack de '.$request->name,
                'prod_code' => 'perso',
                'prod_couleur' => '2',
                'prix' => $prix,
                'quantity' => '1',
                'session_id' => Session::get('session_id'),
                'taille' => '-',
            ]);
            $shopcart->save(); 
        return redirect('/Panier');
    }
}
