<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\facture;
use App\fournisseur;
use App\User;
use App\produit;
use App\produit_commander;
use App\produit_facture;
use App\attributproduit;
use App\commande;
use App\Coupon;
use App\pack_produit;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Input;
use Auth;
use Session;


class FactureController extends Controller
{
  //Afficher Facture des client
	public function index(){
		$facture=facture::where('id_fournisseur','=',0)->where('id_commande','>',0)->orderBy('id','desc')->paginate(20);
		return view('dashboard.tous_factures')->with(array(
			'facture'=>$facture,
		));
	}
  //Afficher Facture des fournisseur
  public function index2(){
    $facture=facture::where('id_fournisseur','>',0)->orderBy('id','desc')->paginate(20);
    return view('dashboard.tous_factures')->with(array(
      'facture'=>$facture,
    ));
  }

    //Afficher facture fourni dans sa compte
    public function FactureF(){
        $id_user=Auth::user()->id;
        $fournisseur=fournisseur::where('id_user','=',$id_user)->paginate(20);
        foreach ($fournisseur as $f) {
          $facture=facture::where('id_fournisseur','=',$f->id)->orderBy('id','desc')->paginate(20);
        }
        
        return view('dashboard.tous_factures')->with(array(
          'facture'=>$facture,
        ));
    }

    /******Ajouter ou afficher facture si elle est existe***/
    public function Add_invoice(Request $request,$id){
      if ($request->isMethod('post')) {
        echo "post";
      }else{
        /****Les produits commanders****/
          $produits=produit_commander::where('id_commande','=',$id)->get();
        /****Tous les produits pour tester et afficher produit pack****/
        $produit=produit::all();
        /****Tous les produits des pack*****/
        $produit_pack=pack_produit::all();
          $facture=facture::where('id_commande','=',$id)->get();
          $countfact=facture::where('id_commande','=',$id)->count();
          if ($countfact > 0) {
            return view('dashboard.facture')->with(array(
                'facture'=>$facture,
                'produits'=>$produits,
                'produit'=>$produit,
                'produit_pack'=>$produit_pack,
            ));
          }else{
            $commande=commande::find($id);
            $fact=new facture();
            $fact->client=$commande->nomclient;
            $fact->tel=$commande->tel;
            $fact->region=$commande->region;
            $fact->ville=$commande->ville;
            $fact->adresse=$commande->adresse;
            $fact->postal=$commande->postal;
            $fact->promo=$commande->promo;
            $fact->total_ht=$commande->total;
            $fact->date=$commande->date;
            $fact->tva=0;
            $fact->timbre=0;
            $fact->total_ttc=$commande->total-$commande->promo;
            $fact->net=$fact->total_ttc;
            $fact->id_commande=$commande->id;
            $fact->code=$commande->code_promo;
            $fact->etat=$commande->etat;
            $fact->tranche=0;
            $fact->rendu=0;
            if ($commande->fournisseur > 0) {
              $fact->id_fournisseur=$commande->fournisseur;
              $fact->methode="Comptant";
            }else{
              $fact->id_fournisseur=0;
              $fact->methode="Livraison";
            }
            $fact->type_promo=$commande->type_promo;
            $fact->save();
            /****Tous les produits pour tester et afficher produit pack****/
            $produit=produit::all();
            /****Tous les produits des pack*****/
            $produit_pack=pack_produit::all();
            $produits=produit_commander::where('id_commande','=',$id)->get();
            $facture=facture::where('id_commande','=',$id)->get();
            return view('dashboard.facture')->with(array(
                'facture'=>$facture,
                'produits'=>$produits,
                'produit'=>$produit,
                'produit_pack'=>$produit_pack,
            ));
            
          }
        
        
      }
    }

    public function destroy(Request $request){
    	$id=$request->get('facture_id');
    	$facture=facture::find($id);
    	$facture->delete();
    	return back()->with('flash_message_success','La facture est supprimé');
    }

    public function Search(Request $request){
    	$data=$request->recherche;
    	$facture=facture::where('client','like','%'.$data.'%')->paginate(20);
    	if($facture != NULL){
    		return view('dashboard.tous_factures')->with(array(
    			'facture'=>$facture,
    		));
    	}
    	else{
    		return view('dashboard.facture');
    	}
    }


    public function facture_fournisseur($id){
      $user=User::find($id);
      $produit_dropdown=produit::with('attributes')->get();
      $fourni=fournisseur::where('id_user','=',$id)->get();
      $last_facture=facture::latest()->first();
      if ($last_facture->client == "" && $last_facture->id != NULL) 
      {
        $produits=produit_facture::where('id_facture','=',$last_facture->id)->get();
        return view('dashboard.Addfacture')->with(array(
        'user'=>$user,
        'fourni'=>$fourni,
        'produit_dropdown'=>$produit_dropdown,
        'produits'=>$produits,
        ));

      }else{
        $produits=NULL;
        return view('dashboard.Addfacture')->with(array(
        'user'=>$user,
        'fourni'=>$fourni,
        'produit_dropdown'=>$produit_dropdown,
        'produits'=>$produits,
        ));
      }
    }

    public function get_size($id){
      //$id=Input::get('id');
      $attribut=attributproduit::where('prod_id','=',$id)->get();
      return response()->json($attribut);
    }


/****fonction pour retourner les produit de la facture a la page facture manuel (facture qui est imprimer)*****/
    public function PapperInvoice($id){
      $facture=facture::find($id);
      /****Tous les produits pour tester et afficher produit pack****/
      $produit=produit::all();
      /****Tous les produits des pack*****/
      $produit_pack=pack_produit::all();
      /*****Les produits de cette facture*****/
      $produits=produit_facture::where('id_facture','=',$id)->get();
      return view('dashboard.facture_manuel')->with(array(
        'facture'=>$facture,
        'produits'=>$produits,
        'produit'=>$produit,
        'produit_pack'=>$produit_pack,
      ));
    }

    public function VoirFactureF($id){
      $facture=facture::find($id);
      $produits=produit_facture::where('id_facture','=',$id)->get();
      return view('dashboard.facture')->with(array(
                'facture'=>$facture,
                'produits'=>$produits
            ));
    }


    public function AjouterProduitFacture(Request $request){
      $session_id=Session::get('session_id');
      if (empty($session_id)) {
        $session_id=str_random(40);
        Session::put('session_id',$session_id);
      }
      $data=$request->all();
      if ($request->size == 0) {
        $taille=0;
        $prix=$request->prod_prix;
        $TestProduit=produit_facture::where(['session_id'=>$session_id,'id_produit'=>$data['prod_id']])->count();
        if ($TestProduit > 0) {
          return back()->with('flash_message_error','Le produit déjà dans la panier');
        }
      }else{
        $sizeArr=explode("-", $request->size);
        $taille=$sizeArr[1];
        $prix=$sizeArr[0];
        $TestProduit=produit_facture::where(['session_id'=>$session_id,'id_produit'=>$data['prod_id'],'size'=>$taille])->count();
        if ($TestProduit > 0) {
          return back()->with('flash_message_error','Le produit déjà dans la panier');
        }
      }


      $pf=new produit_facture();
      $pf->id_facture=0;
      $pf->id_produit=$data['prod_id'];
      $pf->designation=$data['prod_nom'];
      $pf->prix_venteHT=$prix;
      $pf->qty=$data['qty2'];
      $pf->montant_ttc=$prix*$data['qty2'];
      $pf->size=$taille;
      $pf->session_id=$session_id;
      $pf->save();
      return back()->with('flash_message_success','Produit ajouté avec succé');
      
    }

    
    
    public function DeleteProduct($id){
      $produit=produit_commander::find($id);
      if($produit != NULL){
        $idcomm=$produit->id_commande;
        $produit->delete();
        //Modifier le total de la facture
          $pc=produit_commander::where('id_commande','=',$idcomm)->get();
          $total=0;
          foreach ($pc as $p) {
            $total=$total+$p->qty*$p->price;
          }
          $facture=facture::where('id_commande','=',$idcomm)->get();
          $ttc=$total;
          $net=0;
          foreach ($facture as $k) {
              
              if ($k->type_promo == "Fixe") {
                $ttc-=$k->promo;
                $net=$ttc;
              }

              if ($k->type_promo == "Pourcentage") {
                  $pourcentage=($k->promo/$k->total_ht)*100;
                  $promo=$total*$pourcentage/100;
                  $ttc-=$promo;
                  $net=$ttc;
                  $k->promo=$promo;
              }

              if ($k->tva > 0) {
                $ttc=$ttc*$k->tva/100;
                $net=$ttc;
              }

              if ($k->tranche > 0) {
                $net=$ttc-$k->tranche;
              }
              $k->net=$net;
              $k->total_ht=$total;
              $k->total_ttc=$ttc;
              $k->update();
          }
        //fin modification facture
      return back();
      }
    }

    public function AjouterProduitFactureModification(Request $request,$id){
      $produit=produit::find($request->id_produit);
      $attribut=attributproduit::find($request->size);
      $produitF=new produit_commander();
      $produitF->id_commande=$id;
      $produitF->id_produit=$request->id_produit;
      $produitF->nom_produit=$produit->nom;
      $produitF->code_produit=$produit->code;
      $produitF->qty=$request->qty2;
      $produitF->session_id="";
      if ($attribut != NULL) {
        $produitF->taille=$attribut->taille;
        $produitF->price=$attribut->prix_at;
      }
      else{
        $produitF->taille="";
        $produitF->price=$produit->prix;
      }

      $produitF->save();
      //Modifier le total de la facture
      $pc=produit_commander::where('id_commande','=',$id)->get();
      $total=0;
      foreach ($pc as $p) {
        $total=$total+$p->qty*$p->price;
      }
      $ttc=$total;
      $net=0;
      $facture=facture::where('id_commande','=',$id)->get();
      foreach ($facture as $k) {
          if ($k->type_promo == "Fixe") {
          $ttc-=$k->promo;
          $net=$ttc;
          }

          if ($k->type_promo == "Pourcentage") {
            $pourcentage=($k->promo/$k->total_ht)*100;
            $promo=$total*$pourcentage/100;
            $ttc-=$promo;
            $net=$ttc;
            $k->promo=$promo;
          }
          if ($k->tva > 0) {
            $ttc=$ttc+($ttc*$k->tva/100)+0.600;
            $net=$ttc;
          }

          if ($k->tranche > 0) {
            $net=$ttc-$k->tranche;
            
          }
          $k->net=$net;
          $k->total_ht=$total;
          $k->total_ttc=$ttc;
          $k->update();
      }
      //fin modification facture
      return back()->with('flash_message_success','Le produit est ajouté avec succés');
    }



    public function get_element_update_invoice($id){
      $facture=facture::find($id);
            $fourni=fournisseur::where('id','=',$facture->id_fournisseur)->get();
            $produit_dropdown=produit::with('attributes')->get();
            $produits=produit_commander::where('id_commande','=',$facture->id_commande)->get();
            return view('dashboard.ModifierFacture')->with(array(
              'facture'=>$facture,
              'produits'=>$produits,
              'produit_dropdown'=>$produit_dropdown,
              'fourni'=>$fourni,
            ));
    }

    public function ModifierFacture(Request $request ,$id){
      $data=$request->all();
      $facture=facture::find($id);
      $facture->methode=$data['paiement'];
      if ($data['paiement']=="Par tranche") {
        
        if ($facture->total_ttc-($facture->tranche+$data['tranche']) > 0) {
          $facture->tranche += $data['tranche'];
          $facture->net =$facture->net-$data['tranche'];
          if ($facture->net == 0) {
            $facture->etat="Payé";
          }
        }else{
          $reste=$facture->net;
          return back()->with('flash_message_error','Il vous reste ' .$reste. ' à payé');
        }
      }else{
        $facture->net=0;
      }
      $facture->update();
      return back()->with('flash_message_success','Facture modifié');
    }

   


    //Recherche par date
    public function SearchDate(Request $request){
      $data=$request->recherche;
      $id_user=Auth::user()->id;
      $fournisseur=fournisseur::where('id_user','=',$id_user)->get();
      foreach ($fournisseur as $f) {
          $facture=facture::where('date','like','%'.$data.'%')->where('id_fournisseur','=',$f->id)->paginate(20);
      }
      if($facture != NULL){
        return view('dashboard.tous_factures')->with(array(
          'facture'=>$facture,
        ));
      }
      else{
        return back();
      }
    }

    //facture personnalisé
    public function FacturePersonnel(){
      $session_id=Session::get('session_id');
      $produit=produit::with('attributes')->get();
      $produits=produit_facture::where('session_id','=',$session_id)->get();
      return view('dashboard.ajouter_facture_manuel')->with(array(
            'produit'=>$produit,
            'produits'=>$produits,
      ));
    }

    public function AddFacturePersonnel(Request $request){
      $session_id=Session::get('session_id');
      $data=$request->all();
      $f=new facture();
      $f->id_commande=0;
      $f->id_fournisseur=0;
      $f->rendu=0;
      $f->client=$data['nom'];
      $f->tel=$data['tel'];
      $f->region=$data['region'];
      $f->ville=$data['ville'];
      $f->adresse=$data['adresse'];
      $f->postal=$data['postal'];
      $f->date=$data['date'];
      $f->tva=$data['tva'];
      $f->timbre=$data['timbre'];
      $f->methode=$data['paiement'];
      if ($data['paiement'] == "Par tranche") {
        $f->tranche=$data['tranche'];
      }else{
        $f->tranche=0;
      }
      $f->promo=0;
      $f->type_promo="";
      $f->code="";
      $f->etat="";
      $f->total_ht=0;
      $f->total_ttc=0;
      $f->net=0;
      $f->save();

      $facture=facture::latest()->first(); 


      $pf=produit_facture::where('session_id','=',$session_id)->get();
      foreach ($pf as $val) {
        $val->id_facture=$facture->id;
        $val->update();
      }

           
     
      

      $s=produit_facture::where('id_facture','=',$facture->id)->sum('montant_ttc');
      $net=$s;
      $ttc=$s;
      $facture->total_ht=$s;
      /****Calcul des promotions (ttc)***/
      if ($data['remise']=="fixe") {
        $ttc=$ttc-$data['Fixe'];
        $facture->promo=$data['Fixe'];
        $facture->type_promo="Fixe";
      }

      if ($data['remise']=="pourcentage") {
        $promo=$ttc*$data['Pourcentage']/100;
        $ttc=$ttc-$promo;
        $facture->promo=$promo;
        $facture->type_promo="Pourcentage";
      }

      if ($data['remise']=="code_promo") {
        $codepromo=Coupon::where('coupon_code','=',$data['code'])->get();
        $today=date('Y-m-d');
        if ($codepromo != NULL) {
          foreach ($codepromo as $code) {
            if ($code->date_expiration >= $today && $code->statut==1) {
              if ($code->montant_type == "pourcentage") {
                $promo=$ttc*$code->montant/100;
                $ttc=$net-$promo;
                $facture->promo=$promo;
                $facture->code=$code->coupon_code;
                $facture->type_promo="Pourcentage";
                }else{
                  $ttc=$ttc-$code->montant;
                  $facture->code=$code->coupon_code;
                  $facture->type_promo="Fixe";
                }
                }else{
                  return back()->with('flash_message_error',"La date de la code promo est expiré ou le code est désactivé maintenant");
                }
              }
                
                
              }else{
                return back()->with('flash_message_error',"Le code promo n'existe pas");
              }
            }
            /*****Fin calcul promotion en ttc****/


              /****Calcul tva(ttc) avec net si le paiement par tranche***/
              if ($facture->tva != 0) {
                $ttc=$ttc+($ttc*$facture->tva/100)+$facture->timbre;
                if ($data['paiement']=="Par tranche") {
                  $net=$ttc-$data['tranche'];
                  $facture->etat="En cours";
                }else{
                  $net=0;
                  $facture->etat="Payé";
              }
                
            }else{
                if ($data['paiement']=="Par tranche") {
                  $net=$ttc-$data['tranche'];
                  $facture->etat="En cours";
                }else{
                  $net=0;
                  $facture->etat="Payé";
                }
            }

            /****Fin calcul ttc****/


            $facture->total_ttc=$ttc;
            $facture->net=$net;
            $facture->update();
            Session::forget('session_id');
            return redirect('/FacturePersonnaliser')->with('flash_message_success','Facture ajouté avec succé');
    }

    public function get_facture_personal(){
      $facture=facture::where('id_fournisseur','=',0)->where('id_commande','=',0)->orderBy('id','desc')->paginate(20);
      return view('dashboard.facturePersonnel')->with(array(
        'facture'=>$facture,
      ));
    }

    /****Chercher une facture personnalisé***/
    public function SearchInvoicePersonnal(Request $request){
      $data=$request->recherche;
      $facture=facture::where('client','like','%'.$data.'%')->where('id_commande','=',0)->where('id_fournisseur','=',0)->get();
      if($facture != NULL){
        return view('dashboard.facturePersonnel')->with(array(
          'facture'=>$facture,
        ));
      }
      else{
        return back();
      }
    }



    /*****Fonction pour payé une tranche***/
    public function Pay_a_slice(Request $request){
     $data=$request->tranche;
     $id=$request->facture_id;
     $facture=facture::find($id);
     $reste=$facture->total_ttc-$facture->tranche;
     $facture->tranche+=$data;
     if ($facture->total_ttc < $facture->tranche) {
       return back()->with('flash_message_error',"Il vous reste ".$reste." TND à payé.");
     }
     $facture->net-=$data;
     if ($facture->net <= 0) {
       $facture->etat="Payé";
     }
     $facture->update();
     return back()->with('flash_message_success','Tranche payé');
    }

    public function DeleteProductInvoicePersonal($id){
      $produit=produit_facture::find($id);
      if ($produit->id_facture == 0) {
        $produit->delete();
        return back();
      }
      $id_facture=$produit->id_facture;
      $produit->delete();
      /**modifier total facture**/
      $ht=produit_facture::where('id_facture','=',$id_facture)->sum('montant_ttc');
      $facture=facture::find($id_facture);
      $ttc=$ht;
      $net=0;


      if ($facture->promo > 0) {
        if ($facture->type_promo == "Fixe") {
        $ttc-=$facture->promo;
        }

        if ($facture->type_promo == "Pourcentage") {
          $pourcentage=($facture->promo/$facture->total_ht)*100;
          $promo=$ht*$pourcentage/100;
          $ttc-=$promo;
          $facture->promo=$promo;
        }
      }

      if ($facture->tva > 0 ) {
        $ttc=$ttc+($ttc*($facture->tva/100))+0.600;
      }

      

      if ($facture->tranche > 0) {
        $net=$ttc-$facture->tranche;
        $facture->net=$net;
      }

      $facture->total_ht=$ht;
      $facture->total_ttc=$ttc;

      $facture->update();
      
      return back()->with('flash_message_success','Le produit est supprimé');
    }

  
    public function UpdateInvoicePersonal(Request $request,$id){
      if ($request->isMethod('post')) {
            $data=$request->all();
            $facture=facture::find($id);
            $facture->id_commande=0;
            $facture->client=$data['nom'];
            $facture->tel=$data['tel'];
            $facture->region=$data['region'];
            $facture->ville=$data['ville'];
            $facture->adresse=$data['adresse'];
            $facture->postal=$data['postal'];
            $facture->date=$data['date'];
            $total_produit=produit_facture::where('id_facture','=',$facture->id)->sum('montant_ttc');
            if ($data['remise'] == 0) {
              $facture->total_ht=$total_produit;
              $facture->total_ttc=$total_produit-$data['Actuelpromo'];
            }
              
            if ($data['remise']=="fixe") {
              $facture->promo=$data['Fixe'];
              $facture->total_ttc=$total_produit-$data['Fixe'];
              $facture->type_promo="Fixe";
            }

            if ($data['remise']=="pourcentage") {
              $promo=$total_produit*$data['Pourcentage']/100;
              $facture->total_ttc=$total_produit-$promo;
              $facture->promo=$promo;
              $facture->type_promo="Pourcentage";
            }

            if ($data['remise']=="code_promo") {
              $codepromo=Coupon::where('coupon_code','=',$data['code'])->get();
              $today=date('Y-m-d');
              if ($codepromo != NULL) {
                foreach ($codepromo as $code) {
                  if ($code->date_expiration >= $today && $code->statut==1) {
                    if ($code->montant_type == "pourcentage") {
                      $promo=$total_produit*$code->montant/100;
                      $facture->total_ttc=$total_produit-$promo;
                      $facture->promo=$promo;
                      $facture->code=$code->coupon_code;
                      $facture->type_promo="Pourcentage";
                      }else{
                        $facture->total_ttc=$total_produit-$code->montant;
                        $facture->code=$code->coupon_code;
                        $facture->type_promo="Fixe";
                      }
                  }else{
                    return back()->with('flash_message_error',"La date de la code promo est expiré ou le code est désactivé maintenant");
                  }
                }
              }else{
                  return back()->with('flash_message_error',"Le code promo n'existe pas");
              }
            }
            


            $facture->tva=$data['tva'];
            if ($data['tva'] > 0) {
              $facture->total_ttc=$facture->total_ttc*$data['tva']/100;
              $facture->timbre=$data['timbre'];
              $facture->total_ttc+=$data['timbre'];
            }
            
            $facture->methode=$data['paiement'];
            if ($data['paiement'] == "Par tranche") {
              $facture->tranche+=$data['tranche'];
              $facture->net=$facture->total_ttc-$data['tranche'];
            }
            
            $facture->update();
            return redirect('/FacturePersonnaliser')->with('flash_message_success','La facture est bien modifié');
      }else{
        $produit=produit::with('attributes')->get();
        $facture=facture::find($id);
        $produits=produit_facture::where('id_facture','=',$id)->get();
        return view('dashboard.UpdateInvoicePersonal')->with(array(
          'facture'=>$facture,
          'produits'=>$produits,
          'produit'=>$produit,
        ));
      }
    }



    /***Fonction ajouter produit de la vue modifier facture personnalisé***/
    public function APFPM(Request $request,$id){
      $data=$request->all();
      $facture=facture::find($id);
      $p=produit::find($data['id_produit']);
      $produit=new produit_facture();
      $produit->id_facture=$facture->id;
      $produit->id_produit=$p->id;
      $produit->designation=$p->nom;
      if ($data['size'] > 0) {
        $attribut=attributproduit::find($data['size']);
        $produit->prix_venteHT=$attribut->prix_at;
        $produit->qty=$data['qty2'];
        $produit->montant_ttc=$data['qty2']*$attribut->prix_at;
      }else{
        $produit->prix_venteHT=$p->prix;
        $produit->qty=$data['qty2'];
        $produit->montant_ttc=$data['qty2']*$p->prix;
      }
      $produit->save();
      /******Modifier calcul de la facture*****/
      
      $promo=0;
      $ht=produit_facture::where('id_facture','=',$id)->sum('montant_ttc');
      $ttc=$ht;
      if ($facture->type_promo == "Fixe") {
        $ttc-=$facture->promo;
      }

      if ($facture->type_promo == "Pourcentage") {
        $pourcentage=($facture->promo/$facture->total_ht)*100;
        $promo=$ht*$pourcentage/100;
        $ttc-=$promo;
        $facture->promo=$promo;
      }
      
      if ($facture->tva > 0) {
        $ttc=$ttc+($ttc*$facture->tva/100)+0.600;
      }

      if ($facture->tranche > 0) {
        $net=$ttc-$facture->tranche;
        $facture->net=$net;
      }

      $facture->total_ht=$ht;
      $facture->total_ttc=$ttc;
      $facture->update();
      /******Fin modification calcul facture****/

      return back()->with('flash_message_success','Produit ajouter avec succée');
    }


    //Supprimer tout facture séléctionner
    public function DeleteAllSelected(Request $request){
      $data=$request->all();
        foreach ($data['all'] as $tous => $val) {
            $facture=facture::find($val);
            if ($facture->id_commande == 0 && $facture->id_fournisseur == 0) {
              $produit_facture=produit_facture::where('id_facture','=',$facture->id)->get();
            }else{
              $produit_facture=produit_commander::where('id_commande','=',$facture->id_commande)->get();
            }
            foreach ($produit_facture as $pf) {
                $pf->delete();
            }
            $facture->delete();
        }
        return back()->with('flash_message_success','Les factures supprimés');
    }

    public function Export20FacturePdf(){
      $today=date('Y-m-d');
      $facture=facture::orderBy('id','DESC')->where('date','=',$today)->get();
      
        $html='
        <!DOCTYPE html>
          <html lang="en">
        <head>
          <meta charset="utf-8">
          <title>Commande</title>
    
          <style type="text/css">
          .clearfix:after {
          content: "";
          display: table;
          clear: both;
          }

        a {
          color: #5D6975;
          text-decoration: underline;
        }

        body {
          position: relative;
          width: 19.2cm;  
          height: 29.7cm; 
          margin: 0 auto; 
          color: #001028;
          background: #FFFFFF; 
          font-family: Arial, sans-serif; 
          font-size: 12px; 
          font-family: Arial;
        }

        header {
          padding: 10px 0;
          margin-bottom: 30px;
        }

        #logo {
          text-align: center;
          margin-bottom: 10px;
        }

        #logo img {
          width: 200px;
        }

        h1 {
          border-top: 1px solid  #5D6975;
          border-bottom: 1px solid  #5D6975;
          color: #5D6975;
          font-size: 2.4em;
          line-height: 1.4em;
          font-weight: normal;
          text-align: center;
          margin: 0 0 20px 0;
        }

          #project {
            float: left;
          }

          #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-left: 10px;
            display: inline-block;
            font-size: 0.8em;
          }

          #company {
            position: absolute;
            top: 280px;
            right:0;
            left:620px;
            width: 200px;
            height: 100px;
            border:;
          }

          #project div,
          #company div {
            white-space: nowrap;        
          }

          table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
          }

          table tr:nth-child(2n-1) td {
            background: #F5F5F5;
          }

          table th,
          table td {
            text-align: center;
          }

          table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;        
            font-weight: normal;
          }

          table .service,
          table .desc {
            text-align: left;
          }

          table td {
            padding: 20px;
            text-align: right;
          }

          table td.service,
          table td.desc {
            vertical-align: top;
          }

          table td.unit,
          table td.qty,
          table td.total {
            font-size: 1.2em;
          }

          table td.grand {
            border-top: 1px solid #5D6975;;
          }

          #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
          }

          footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
          }
              </style>
            </head>
            <body>
              <header class="clearfix">
                
              <center>';
              $html.='  
              <img src="{{asset(assets/images/logo.png)}}">';
              $html.='<h4>
                  Date :'.$today.'
                </h4></center>
              </header>
              <main>
                <table>
                  <thead>
                  <tr>
                      <th>Date</th>
                      <th>Client</th>
                      <th>Téléphone</th>
                      <th>Région</th>
                      <th>Total_HT</th>
                      <th>Total_TTC</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                ';
                foreach ($facture as $d) {
                  $html.='
                      <tr>
                                      <td>
                                          <p>'.$d->date.'</p>
                                      </td>
                                                    
                                      <td>
                                          <p>'.$d->client.'</p>
                                      </td>
                                                  
                                                    
                                                  

                                      <td>
                                          <p>'.$d->tel.'</p>
                                      </td>

                                                    

                                      <td>
                                        <p>'.$d->region.'</p>
                                      </td>
                                      <td>
                                          <p>'.$d->total_ht.'</p>
                                      </td>

                                      <td>
                                          <p>'.$d->total_ttc.'</p>
                                      </td>
                                    </tr>
                  ';
      }
      $html.='</tbody>
      </table> </main></body></html>
        ';
        $pdf = new Dompdf(); 
        $pdf->loadHtml($html);
        $pdf->render();
        return $pdf->setPaper('a4','landscape')->stream('Facture'.$today.'.pdf');
    }

    /*public function ImprimerFacturePdf($id){
    	$facture=facture::find($id);
        $produit=produit_commander::where('id_commande','=',$facture->id_commande)->get();
        $html='
        <!DOCTYPE html>
              <html lang="en">


              <head>
              <meta charset="utf-8" />
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <meta name="viewport" content="width=device-width, initial-scale=1">
              <link href="http://demo.harnishdesign.net/html/koice/images/favicon.png" rel="icon" />
              <title>Flight Booking Invoice - Koice</title>
              <meta name="author" content="harnishdesign.net">

              <!-- Web Fonts
              ======================= -->
              <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" type="text/css">

              <!-- Stylesheet
              ======================= -->
              <link rel="stylesheet" type="text/css" href="http://demo.harnishdesign.net/html/koice/vendor/bootstrap/css/bootstrap.min.css"/>
              <link rel="stylesheet" type="text/css" href="http://demo.harnishdesign.net/html/koice/vendor/font-awesome/css/all.min.css"/>
              <link rel="stylesheet" type="text/css" href="http://demo.harnishdesign.net/html/koice/css/stylesheet.css"/>
              </head>
              <body>
              <!-- Container -->
              <div class="container-fluid invoice-container"> 
                <!-- Header -->
                <header>
                  <div class="row align-items-center">
                    <div class="col-sm-7 text-center text-sm-left mb-3 mb-sm-0"> <img id="logo" src="C:\wamp64\www\e-commerce\public\assets\images\logo.png" title="VIORE" alt="VIORE" style="width:40%;height:40%;"/> </div>
                    <div class="col-sm-5 text-center text-sm-right">
                      <h4 class="mb-0">Facture</h4>
                      <p class="mb-0">Numéro de facture - 16835</p>
                    </div>
                  </div>
                  <hr>
                </header>
                
                <!-- Main Content -->
                <main>
                  <div class="row">
                    <div class="col-sm-6 text-sm-right order-sm-1"> <strong>Payer pour:</strong>
                      <address>
                      Koice Inc<br />
                      2705 N. Enterprise St<br />
                      Orange, CA 92865
                      </address>
                    </div>
                    <div class="col-sm-6 order-sm-0"> <strong>Facturé à:</strong>
                      <address>
                      Smith Rhodes<br />
                      15 Hodges Mews, High Wycombe<br />
                      HP12 3JL<br />
                      United Kingdom
                      </address>
                    </div>
                  </div>
                  <div class="row">
                    <!--<div class="col-sm-6 mb-3"> <strong>Mode de paiement:</strong><br>
                      <span>Paiement à la livraison</span> </div>-->
                  <div class="col-sm-6 mb-3"></div>
                    <div class="col-sm-6 mb-3 text-sm-right"> <strong>Date :</strong>
                      <span> 07/11/2020</span> </div>
                  </div>
                  <div class="card">
                    <div class="card-header px-3"> <span class="font-weight-600 text-4">Commande</span> </div>
                    <div class="card-body px-2 py-0">
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <td class="col-6 border-top-0"><strong>Détail de la commande</strong></td>
                              <td class="col-2 text-center border-top-0"><strong>Quantité</strong></td>
                      <td class="col-2 text-center border-top-0"><strong>Prix</strong></td>
                              <td class="col-2 text-right border-top-0"><strong>Total</strong></td>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                      
                              <td><span class="text-3"><span class="font-weight-500">Indigo 6E-2726</span> - Delhi to Sydney</span> <br>
                                Travel Date - Sat, 15 Jun 19, 01:50 hrs <br>
                                Smith Rhodes </td>
                        <td class="text-center">1</td>
                              <td class="text-center">$980.00</td>
                              
                              <td class="text-right">$980.00</td>
                            </tr>
                            <tr>
                      
                              <td><span class="text-3"><span class="font-weight-500">JetAirways MD-270</span> - Sydney to Delhi</span> <br>
                                Travel Date - Mon, 01 July 19, 19:38 hrs <br>
                                Smith Rhodes </td>
                        <td class="text-center">3</td>
                              <td class="text-center">$999.00</td>
                              
                              <td class="text-right">$999.00</td>
                            </tr>
                            <tr>
                              <td colspan="2" class="bg-light-2 text-right"><strong>Sous-total</strong></td>
                              <td colspan="2" class="bg-light-2 text-right">$1979.00</td>
                            </tr>
                            <tr>
                              <td colspan="2" class="bg-light-2 text-right"><strong>Code promo:</strong><br>
                                <span class="text-1">summerfun - 20.00%</span></td>
                              <td colspan="2" class="bg-light-2 text-right">-$395.80</td>
                            </tr>
                            <tr>
                              <td colspan="2" class="bg-light-2 text-right"><strong>Total</strong></td>
                              <td colspan="2" class="bg-light-2 text-right">$1583.20</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <br>
                  
                </main>
                <!-- Footer -->
                <footer class="text-center">
                  <p class="text-1"><strong>NOTE :</strong> This is computer generated receipt and does not require physical signature.</p>
                </footer>
              </div>
              </body>
              </html>
                      ';
        $pdf = new Dompdf(); 
        $pdf->loadHtml($html);
        $pdf->render();
        $today = date("d-m-y");
        return $pdf->setPaper('a4','landscape')->stream('facture_'.$today.'.pdf');
    }*/
}
