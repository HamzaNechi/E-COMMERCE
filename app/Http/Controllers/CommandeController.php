<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests;
use App\produit;
use App\produit_commander;
use App\commande;
use App\cart;
use App\categorie;
use Session;
use DB;
use Dompdf\Dompdf;
use App\attributproduit;
use App\fournisseur;
use Auth;
use App\Coupon;
use App\pack_produit;
use App\User;
use App\Notifications\NewOrderNotification;

class CommandeController extends Controller
{

    /*****Supprimer produit de la table produit_commander***/
    public function DeleteProductFromCommand($id)
    {
        $produit=produit_commander::find($id);
        $produit->delete();
        return back()->with('flash_message_success', 'Produit supprimé');
    }
    

    

    /*****Ajouter commande client vitrine****/
    public function Ajouter_commande(Request $request)
    {
        $session_id=Session::get('session_id');
        $cart=cart::where('session_id', '=', $session_id)->get();
        if(sizeof($cart) == 0){
            return back()->with('flash_message_error','La panier est vide');
        }
        //verifier formulaire
        $this->validate($request, [
            'nomclient' => 'required',
            'tel' => 'required',
             'region' => 'required',
             'ville' => 'required',
             'adresse' => 'required',
             'postal' => 'required',
        ]);
        //save commande
        $data=$request->all();
        $code=$this->generateCode();
      
      
        $today = date("Y-m-d");
        $commande=new commande();
        $commande->nomclient=$data['nomclient'];
        $commande->tel=$data['tel'];
        $commande->region=$data['region'];
        $commande->ville=$data['ville'];
        $commande->adresse=$data['adresse'];
        $commande->postal=$data['postal'];
        $commande->net=$data['net'];
        $commande->promo=$data['promo'];
        $commande->total=$data['total_prod'];
        $commande->date=$today;
        $commande->code_promo=$data['codepromo'];
        $commande->etat="En cours";
        $commande->code_commande=$code;
        $commande->type_promo=$data['type_promo'];
        $commande->fournisseur=0;
        $commande->save();
        //save product
        $last_commande=commande::latest()->first();
        foreach ($cart as $key) {
            $productcart=new produit_commander();
            $productcart->id_commande=$last_commande->id;
            $productcart->nom_produit=$key->prod_nom;
            $productcart->code_produit=$key->prod_code;
            $productcart->qty=$key->quantity;
            $productcart->price=$key->prix;
            $productcart->id_produit=$key->prod_id;
            $productcart->taille=$key->taille;
            $productcart->session_id=0;
            $productcart->save();
            /****Modifier stock de produit***/
            $pro=produit::find($key->prod_id);
            /***Si le produit est un pack***/
            if ($pro->type == "pack") {
                $produit_pack=pack_produit::where('id_pack', '=', $pro->id)->get();
                foreach ($produit_pack as $pack) {
                    if ($pack->prod_taille != 0) {
                        /***Modifier total produit**/
                        $productpack=produit::find($pack->prod_id);
                        $productpack->total_stock=$productpack->total_stock-$pack->qty*$key->quantity;
                        $productpack->update();
                        /***Modifier total attribut***/
                        $attrr=attributproduit::where(['prod_id'=>$pack->prod_id,'taille'=>$pack->prod_taille])->get();
                        foreach ($attrr as $at) {
                            $at->stock=$at->stock-$pack->qty*$key->quantity;
                            $at->update();
                        }
                    } else {
                        $productpack=produit::find($pack->prod_id);
                        $productpack->total_stock=$productpack->total_stock-$pack->qty*$key->quantity;
                        $productpack->update();
                    }
                }
            }
            /***Fin modification stock produit pack**/
            if ($key->taille == 0) {
                $pro->total_stock=$pro->total_stock-$key->quantity;
                $pro->update();
            } else {
                $pro->total_stock=$pro->total_stock-$key->quantity;
                $pro->update();
                /***Modifier stock attribut**/
                $attr=attributproduit::where(['prod_id'=>$key->prod_id,'taille'=>$key->taille])->get();
                foreach ($attr as $at) {
                    $at->stock=$at->stock-$key->quantity;
                    $at->update();
                }
            }
            /****Fin modification stock ****/
        }

        //Vider session
        Session::forget('session_id');
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        /*****Add notification******/
        $orderNotificationDetails=$data;
        $admins=User::where('role', '!=', 2)->get();
        Notification::send($admins, new NewOrderNotification($orderNotificationDetails));
        event(new \App\Events\NotificationOrder(1, $orderNotificationDetails));
        return view('vitrine.commande_envoyer')->with(array(
            'last_commande'=>$last_commande,
        ));
    }


    
    /****Afficher tous les commandes client pour l'admin****/
    public function voir_commande()
    {
        $commande=commande::where('fournisseur', '=', 0)->orderBy('id', 'desc')->paginate(20);
        return view('dashboard.commande')->with(array(
          'commande' => $commande,
      ));
    }

    
    /******Ajouter produit dans la page de modification***/
    public function AddproductUpdate(Request $request)
    {  
        $data=$request->all();
        $produit=produit::find($data['id_produit']);
        /***test 1:Tester si le produit est un pack verifier si les stocks des produits du packs valide */
        if($produit->type=="pack"){
            $packProduct=pack_produit::where('id_pack','=',$data['id_produit'])->get();
            foreach($packProduct as $val){
                $qtyProduct=produit::find($val->prod_id);
                if($qtyProduct->total_stock == 0){
                    return back()->with('flash_message_error',"Le stock de la produit ".$qtyProduct->nom." est insuffisant");
                }
            }
        }
        /***Fin test 1 */


        /*****Test 2 : tester si le produit est dans le stock ou non */
        $produit=produit::find($data['id_produit']);
        if($produit->total_stock == 0){
            return back()->with('flash_message_error','Le stock de produit est insuffisant');
        }
        /***fin test 2 */
        $produit_commander=new produit_commander();
        $produit_commander->id_commande=$data['id_command'];
        $produit_commander->nom_produit=$produit->nom;
        $produit_commander->code_produit=$produit->code;
        $produit_commander->id_produit=$produit->id;
        $produit_commander->qty=$data['qty2'];
        $produit_commander->session_id="";
        if ($data['size'] > 0) {
            $attribut=attributproduit::find($data['size']);
            $produit_commander->price=$attribut->prix_at;
            $produit_commander->taille=$attribut->taille;
            $produit_commander->save();
        } else {
            $produit_commander->price=$produit->prix;
            $produit_commander->taille=0;
            $produit_commander->save();
        }
      
        //update total commande
        $prodsom=produit_commander::where('id_commande', '=', $data['id_command'])->get();
        $total=0;
        foreach ($prodsom as $key) {
            $total=$total+$key->price*$key->qty;
        }
        $commande=commande::find($data['id_command']);
      
        if ($commande->promo > 0) {
            if ($commande->type_promo == "Fixe") {
                $net=$total-$commande->promo;
            }

            if ($commande->type_promo == "Pourcentage") {
                $pourcentage=($commande->promo/$commande->total)*100;
                $promo=$total*$pourcentage/100;
                $commande->promo=$promo;
                $net=$total-$promo;
            }
        } else {
            $net=$total;
        }
        //End update total command


        /**Modifier stock produit**/
        if ($data['size'] > 0) {
            $produit->total_stock=$produit->total_stock-$data['qty2'];
            $produit->update();

            $attribut->stock=$attribut->stock-$data['qty2'];
            $attribut->update();
        } else {
            $produit->total_stock=$produit->total_stock-$data['qty2'];
            $produit->update();
        }
        
        /***Si le produit est un pack modifier le stock du produit du pack */
            //produit=(table produit) qui arrive a travers la table produit commander
            //packproduct=(table pack_produit) les produits de cet pack
            //prodpack=(produit) qui arrive à travers la table produit pack
            if($produit->type == "pack"){
                $packproduct=pack_produit::where('id_pack','=',$produit->id)->get();
                foreach($packproduct as $ppro){
                    $prodpack=produit::find($ppro->prod_id);
                    $prodpack->total_stock=$prodpack->total_stock-$ppro->qty;
                    $prodpack->update();
                    if($ppro->taille != "0"){
                        $attribut=attributproduit::where(['prod_id'=>$ppro->prod_id , 'taille'=>$ppro->prod_taille])->first();
                        $attribut->stock-=$ppro->qty;
                        $attribut->update();
                    }
                }
            }
            /****Fin travail stock pack */
            $produit->update();
        /**Fin modifier stock produit**/
        $commande->total=$total;
        $commande->net=$net;
        $commande->update();
        return back();
    }



    /*****Afficher les détails de la commande***/
    public function detail_commande($id)
    {
        $detail_commande=commande::with('produits')->find($id);
        $produit=produit::all();
        $produit_pack=pack_produit::all();
        return view('dashboard.detail_commande')->with(array(
        'detail_commande'=>$detail_commande,
        'produit'=>$produit,
        'produit_pack'=>$produit_pack,
      ));
    }

    /****Rechercher commande par nom client****/
    public function Search_command(Request $request)
    {
        $data=$request->recherche;
        $pos=strpos($data, 'VIORE-');

        if ($pos === false) {
            $commande=commande::where('nomclient', 'like', '%'.$data.'%')->paginate(20);
            if ($commande != null) {
                return view('dashboard.commande')->with(array(
          'commande'=>$commande,
        ));
            } else {
                return view('dashboard.commande');
            }
        } else {
            $commande=commande::where('code_commande', 'like', '%'.$data.'%')->paginate(20);
            if ($commande != null) {
                return view('dashboard.commande')->with(array(
          'commande'=>$commande,
        ));
            } else {
                return view('dashboard.commande');
            }
        }
    }

    
    /****Ajouter produit avec session (ajouter commande manuel pour l'admin et page ajouter commande pour le fournisseur)**/
    public function AjouterAupanier(Request $request)
    {
        // $data=$request->all();
        // $data=json_decode(json_encode($data));
        // echo "<pre>";print_r($data);die;
        $session_id=Session::get('session_id');
        if (empty($session_id)) {
            $session_id=str_random(40);
            Session::put('session_id', $session_id);
        }

        /****tester si il choisir un taille ou return message error */
        $productTest=produit::with('attributes')->find($request->prod_id);
        if(sizeof($productTest->attributes)>0 && $request->taille == 0 ){
            return back()->with('flash_message_error','Choisir votre taille préférer');
        }
        /****fin test taille */
        if ($request->taille == 0) {
            /******Tester si le produit est existe déjà****/
            $countproduct=produit_commander::where(['id_produit'=>$request->prod_id ,'session_id'=>$session_id])->count();
            if ($countproduct > 0) {
                return back()->with('flash_message_error', 'Le produit est déjà existe dans la panier');
            }
            /*****Fin test****/
            $taille=0;
            $prix=$request->prod_prix;
        } else {
            $sizeArr=explode("-", $request->taille);
            $taille=$sizeArr[1];
            $prix=$sizeArr[0];

            /******Tester si le produit est existe déjà****/
            $countproduct=produit_commander::where(['id_produit'=>$request->prod_id ,'session_id'=>$session_id ,'taille'=>$taille])->count();
            if ($countproduct > 0) {
                return back()->with('flash_message_error', 'Le produit est déjà existe dans la panier');
            }
        }


        /****Tester si la quantité > 0 et la quantité de produit existe ou nn***/
        if ($request->qty == 0) {
            return back()->with('flash_message_error', 'Vérifier la quantité que tu veux acheter');
        }
        $produit=produit::find($request->prod_id);
        if ($produit->total_stock < $request->qty) {
            return back()->with('flash_message_error', 'La quantité total de produit dans notre stock est '.$produit->total_stock.'.');
        }
        if ($request->taille != 0) {
            $attribut=attributproduit::where(['prod_id'=>$request->prod_id,'taille'=>$taille])->get();
            if ($attribut[0]['stock'] < $request->qty) {
                return back()->with('flash_message_error', 'La quantité de produit dans cette taille est '.$attribut[0]['stock'].'.');
            }
        }
        /*****Fin tester quantité commander***/
      
        $pc=new produit_commander();
        $pc->nom_produit=$request->prod_nom;
        $pc->code_produit=$request->prod_code;
        $pc->qty=$request->qty;
        $pc->price=$prix;
        $pc->taille=$taille;
        $pc->id_commande=0;
        $pc->id_produit=$request->prod_id;
        $pc->session_id=$session_id;
        $pc->save();
        return back()->with('flash_message_success', 'Produit ajouté avec succé');
    }


    /****Supprimer tous les commandes séléctionnez***/
    public function DeleteAllSelected(Request $request)
    {
        $data=$request->all();
        foreach ($data['all'] as $tous => $val) {
            $commande=commande::find($val);
            $commande->delete();
            $produits=produit_commander::where('id_commande', '=', $val)->get();
            foreach ($produits as $key) {
                /**Supprimer les produits commander de la base et Modifier stock produit**/
        
        
                $produit=produit::find($key->id_produit);
                if ($key->taille > 0 || $key->taille != null) {
                    $produit->total_stock=$produit->total_stock+$key->qty;
                    $produit->update();

                    $attribut=attributproduit::where(['prod_id'=>$key->id_produit,'taille'=>$key->taille])->get();
                    foreach ($attribut as $at) {
                        $at->stock=$at->stock+$key->qty;
                        $at->update();
                    }
                } else {
                    $produit->total_stock=$produit->total_stock+$key->qty;
                    $produit->update();
                }

                /***Si le produit est un pack modifier le stock du produit du pack */
                    //produit=(table produit) qui arrive a travers la table produit commander
                    //packproduct=(table pack_produit) les produits de cet pack
                    //prodpack=(produit) qui arrive à travers la table produit pack
                    if($produit->type == "pack"){
                        $packproduct=pack_produit::where('id_pack','=',$produit->id)->get();
                        foreach($packproduct as $ppro){
                            $prodpack=produit::find($ppro->prod_id);
                            $prodpack->total_stock=$prodpack->total_stock+$ppro->qty;
                            $prodpack->update();
                            if($ppro->taille != "0"){
                                $attribut=attributproduit::where(['prod_id'=>$ppro->prod_id , 'taille'=>$ppro->prod_taille])->first();
                                $attribut->stock+=$ppro->qty;
                                $attribut->update();
                            }
                        }
                    }
                /****Fin travail stock pack */
                $produit->update();
        
                /**Fin modifier stock produit**/
                $key->delete();
            }
        }
        return back()->with('flash_message_success', 'Commandes supprimer');
    }

    /*****Afficher tous les commandes fournisseur pour l'admin***/
    public function voir_commande_f()
    {
        $commande=commande::where('fournisseur', '!=', 0)->orderBy('id', 'desc')->paginate(20);
        return view('dashboard.commande')->with(array(
          'commande' => $commande,
      ));
    }

    /****Rechercher commande fourniiseur par date***/
    public function Search_command_par_date(Request $request)
    {
        $data=$request->recherche;
        $fourni=fournisseur::where('id_user', '=', Auth::user()->id)->get();
      
        foreach ($fourni as $val) {
            $commande=commande::where('date', 'like', '%'.$data.'%')->where('fournisseur', '=', $val->id)->get();
        }
      
        if ($commande != null) {
            return view('dashboard.fournisseur.voircommande')->with(array(
          'commande'=>$commande,
        ));
        } else {
            return view('dashboard.fournisseur.voircommande');
        }
    }

    /*****Afficher les commandes de la fournisseur connecté***/
    public function voir_commande_fournisseur($id)
    {
        $fournisseur=fournisseur::where('id_user', '=', $id)->get();
        foreach ($fournisseur as $f) {
            $commande=commande::where('fournisseur', '=', $f->id)->orderBy('id', 'desc')->get();
        }

      
        return view('dashboard.fournisseur.voircommande')->with(array(
        'commande'=>$commande,
      ));
    }

    /*****Retourner les éléments du page ajouter commande (espace fournisseur)***/
    public function add_command_supplier()
    {
        $session_id=Session::get('session_id');
        $produit=produit::with('attributes')->paginate(12);
        $categories=categorie::all();
        $produits=produit_commander::where('session_id', '=', $session_id)->get();
        return view('dashboard.fournisseur.Ajouter_commande')->with(array(
          'produits'=>$produits,
          'produit'=>$produit,
          'categories'=>$categories,
        ));
    }


    /*****Trié les produit avec catégorie page ajouter commande fournisseur */
    public function TrierProduitCategorie($id){
        $session_id=Session::get('session_id');
        $produit=produit::with('attributes')->where('cat_id','=',$id)->paginate(12);
        $categories=categorie::all();
        $produits=produit_commander::where('session_id', '=', $session_id)->get();
        return view('dashboard.fournisseur.Ajouter_commande')->with(array(
          'produits'=>$produits,
          'produit'=>$produit,
          'categories'=>$categories,
        ));
    }


    /******Ajouter commande du fournisseur****/
    public function PasserCommande()
    {
        $session_id=Session::get('session_id');
        $fournisseur=fournisseur::where('id_user', '=', Auth::user()->id)->get();
        $produit_commander=produit_commander::where('session_id', '=', $session_id)->get();
        if(sizeof($produit_commander) == 0){
            return back()->with('flash_message_error','La panier est vide');
        }
        $commande=new commande();
        $commande->nomclient="";
        $commande->tel="";
        $commande->region="";
        $commande->ville="";
        $commande->adresse="";
        $commande->postal="";
        $commande->fournisseur=0;
        $commande->promo=0;
        $commande->code_promo="";
        $commande->type_promo="";
        $commande->total=0;
        $commande->net=0;
        $commande->code_commande="";
        $commande->date=date("Y-m-d");
        $commande->etat="";
        $commande->save();

        $last=commande::latest()->first();
        
        $commande=commande::find($last->id);
        $total=0;
        foreach ($produit_commander as $tot) {
            $tot->id_commande=$commande->id;
            $tot->update();
            $total=$total+($tot->price * $tot->qty);
        }
        $commande->nomclient=Auth::user()->name;
        $commande->tel=Auth::user()->tel;
        foreach ($fournisseur as $key) {
            $commande->region=$key->region;
            $commande->ville=$key->ville;
            $commande->adresse=$key->adresse;
            $commande->postal=$key->postal;
            $commande->fournisseur=$key->id;
        }
        $commande->promo=0;
        $commande->code_promo="";
        $commande->type_promo="";
        $commande->total=$total;
        $commande->net=$total;
        $commande->code_commande=$this->generateCode();
        ;
        $commande->date= date("Y-m-d");
        $commande->etat="En cours";
        $commande->update();

        foreach ($produit_commander as $pc) {

            //Modifier stock//
            $produit=produit::with('attributes')->find($pc->id_produit);
            $produit->total_stock-=$pc->qty;
            if (sizeof($produit->attributes) > 0) {
                $attribut=attributproduit::where(['prod_id'=>$pc->id_produit,'taille'=>$pc->taille])->get();
                foreach ($attribut as $k) {
                    $k->stock-=$pc->qty;
                    $k->update();
                }
            }
            /***Si le produit est un pack modifier le stock du produit du pack */
            //produit=(table produit) qui arrive a travers la table produit commander
            //packproduct=(table pack_produit) les produits de cet pack
            //prodpack=(produit) qui arrive à travers la table produit pack
            if($produit->type == "pack"){
                $packproduct=pack_produit::where('id_pack','=',$pc->id_produit)->get();
                foreach($packproduct as $ppro){
                    $prodpack=produit::find($ppro->prod_id);
                    $prodpack->total_stock=$prodpack->total_stock-$ppro->qty;
                    $prodpack->update();
                    if($ppro->taille != "0"){
                        $attribut=attributproduit::where(['prod_id'=>$ppro->prod_id , 'taille'=>$ppro->prod_taille])->first();
                        $attribut->stock-=$ppro->qty;
                        $attribut->update();
                    }
                }
            }
            /****Fin travail stock pack */
            $produit->update();
            //Fin modifier stock
        }
        Session::forget('session_id');
        return redirect('/VoirCommande/'.Auth::user()->id)->with('flash_message_success', 'Commande bien reçus');
    }


    /*******Modifier commande(client,fournisseur,manuel)****/
    public function UpdateCommand(Request $request, $id)
    {
        if ($request->isMethod('get')) {
            $commande=commande::find($id);
            $produit_dropdown=produit::all();
            $produits=produit_commander::where('id_commande', '=', $commande->id)->get();
            return view('dashboard.UpdateCommand')->with(array(
          'commande'=>$commande,
          'produits'=>$produits,
          'produit_dropdown'=>$produit_dropdown,
        ));
        } else {
            $data=$request->all();
            $commande=commande::find($id);
            $commande->nomclient=$data['nom'];
            $commande->tel=$data['tel'];
            $commande->region=$data['region'];
            $commande->ville=$data['ville'];
            $commande->postal=$data['postal'];
            $commande->adresse=$data['adresse'];
            $commande->update();
            return back()->with('flash_message_success', 'Commande modifié');
        }
    }



    /****Retourner un produit (fonction jquery ajax)*****/
    public function get_product_json($id)
    {
        $produit=produit::find($id);
        return response()->json($produit);
    }

    /****Annuler commande client de vitrine**/
    public function AnnulerCommande($id)
    {
        $commande=commande::find($id);
        $commande->etat="Annuler";
        $commande->update();
        return redirect('/');
    }

    /*****Supprimer commande***/
    public function Delete(Request $request)
    {
        $id=$request->commande_id;
        $commande=commande::find($id);
        $commande->delete();

        /**Supprimer les produits commander de la base et Modifier stock produit**/
        $produit_commander=produit_commander::where('id_commande', '=', $id)->get();
        if ($produit_commander != null) {
            foreach ($produit_commander as $row) {
                $produit=produit::find($row->id_produit);
                if ($row->taille > 0 || $row->taille != null) {
                    $produit->total_stock=$produit->total_stock+$row->qty;
                    $produit->update();

                    $attribut=attributproduit::where(['prod_id'=>$row->id_produit,'taille'=>$row->taille])->get();
                    foreach ($attribut as $at) {
                        $at->stock=$at->stock+$row->qty;
                        $at->update();
                    }
                } else {
                    $produit->total_stock=$produit->total_stock+$row->qty;
                    $produit->update();
                }

                /***Si le produit est un pack modifier le stock du produit du pack */
                //produit=(table produit) qui arrive a travers la table produit commander
                //packproduct=(table pack_produit) les produits de cet pack
                //prodpack=(produit) qui arrive à travers la table produit pack
                if($produit->type == "pack"){
                    $packproduct=pack_produit::where('id_pack','=',$produit->id)->get();
                    foreach($packproduct as $ppro){
                        $prodpack=produit::find($ppro->prod_id);
                        $prodpack->total_stock=$prodpack->total_stock+$ppro->qty;
                        $prodpack->update();
                        if($ppro->taille != "0"){
                            $attribut=attributproduit::where(['prod_id'=>$ppro->prod_id , 'taille'=>$ppro->prod_taille])->first();
                            $attribut->stock+=$ppro->qty;
                            $attribut->update();
                        }
                    }
                }
                /****Fin travail stock pack */
                $produit->update();
                $row->delete();
            }
        }
        
        /**Fin modifier stock produit**/
        return back()->with('flash_message_success', 'La commande à été supprimé avec succés');
    }


    /*****Modifier l'état de la commande(payé,en cours, annuler)****/
    public function Edit_Etat(Request $request)
    {
        $id=$request->commande_id;
        $etat=$request->etat;
        $commande=commande::find($id);
        $commande->etat=$etat;
        $commande->update();
        return back();
    }

    //Commande manuel

    public function getAllProductForCommandManuel()
    {
        $produit=produit::all();
        $session_id=Session::get('session_id');
        $produits=produit_commander::where(['session_id'=>$session_id , 'id_commande'=>0])->get();
        if (sizeof($produits) <= 0) {
            $produits=null;
        }

        return view('dashboard.AjouterCommandeManuel')->with(array(
        'produit'=>$produit,
        'produits'=>$produits,
      ));
    }

    public function AjoutCommandManuel(Request $request)
    {
        $data=$request->all();
        $session_id=Session::get('session_id');
        $produits=produit_commander::where('session_id', '=', $session_id)->get();
        if(sizeof($produits) == 0){
            return back()->with('flash_message_error','La panier est vide');
        }
        $commande=new commande();
        $total=0;
        foreach ($produits as $pc) {
            $total=$total+($pc->price * $pc->qty);
        }
        $commande->nomclient=$data['nom'];
        $commande->tel=$data['tel'];
        $commande->region=$data['region'];
        $commande->ville=$data['ville'];
        $commande->adresse=$data['adresse'];
        $commande->postal=$data['postal'];
        $commande->fournisseur=0;
        $commande->total=$total;
        if ($data['remise']==0) {
            $commande->net=$total;
            $commande->promo=0;
            $commande->type_promo="";
            $commande->code_promo="";
        }
        if ($data['remise']=="fixe") {
            $commande->net=$total-$data['Fixe'];
            $commande->promo=$data['Fixe'];
            $commande->type_promo="Fixe";

            $commande->code_promo="";
        }

        if ($data['remise']=="pourcentage") {
            $promo=$total*$data['Pourcentage']/100;
            $commande->net=$total-$promo;
            $commande->promo=$promo;
            $commande->type_promo="Pourcentage";

            $commande->code_promo="";
        }

        if ($data['remise']=="code_promo") {
            $codepromo=Coupon::where('coupon_code', '=', $data['code'])->get();
            $today=date('Y-m-d');
            if ($codepromo != null) {
                foreach ($codepromo as $code) {
                    if ($code->date_expiration >= $today && $code->statut==1) {
                        if ($code->montant_type == "pourcentage") {
                            $promo=$total*$code->montant/100;
                            $commande->net=$total-$promo;
                            $commande->promo=$promo;
                            $commande->type_promo="Pourcentage";
                        } else {
                            $commande->net=$total-$code->montant;
                            $commande->type_promo="Fixe";
                        }

                        $commande->code_promo=$data['code'];
                    } else {
                        return back()->with('flash_message_error', "La date de la code promo est expiré ou le code est désactivé maintenant");
                    }
                }
            } else {
                return back()->with('flash_message_error', "Le code promo n'existe pas");
            }
        }
        
        
        
        $commande->code_commande=$this->generateCode();
        $commande->date= date("Y-m-d");
        $commande->etat="En cours";
        $commande->save();


      
        foreach ($produits as $pc) {
            $pc->id_commande=$commande->id;
            $pc->update();

            //Modifier stock//
            $produit=produit::with('attributes')->find($pc->id_produit);
            $produit->total_stock-=$pc->qty;
            $produit->update();
            if (sizeof($produit->attributes) > 0) {
                $attribut=attributproduit::where(['prod_id'=>$pc->id_produit,'taille'=>$pc->taille])->get();
                foreach ($attribut as $k) {
                    $k->stock-=$pc->qty;
                    $k->update();
                }
            }
            /***Si le produit est un pack modifier le stock du produit du pack */
            //produit=(table produit) qui arrive a travers la table produit commander
            //packproduct=(table pack_produit) les produits de cet pack
            //prodpack=(produit) qui arrive à travers la table produit pack
            if($produit->type == "pack"){
                $packproduct=pack_produit::where('id_pack','=',$pc->id_produit)->get();
                foreach($packproduct as $ppro){
                    $prodpack=produit::find($ppro->prod_id);
                    $prodpack->total_stock=$prodpack->total_stock-$ppro->qty;
                    $prodpack->update();
                    if($ppro->taille != "0"){
                        $attribut=attributproduit::where(['prod_id'=>$ppro->prod_id , 'taille'=>$ppro->prod_taille])->first();
                        $attribut->stock-=$ppro->qty;
                        $attribut->update();
                    }
                }
            }
            /****Fin travail stock pack */
        }
        Session::forget('session_id');
        return redirect('/Commande_Client')->with('flash_message_success', 'Commande bien reçus');
    }
    
    //Delete product updatecommand page
    public function DeleteProductFromUpdateCommand($id)
    {
        $produit=produit_commander::find($id);
        $countProduct=produit_commander::where('id_commande','=',$produit->id_commande)->count();
        if($countProduct == 1){
            return back()->with('flash_message_error','La commande ne peux pas étre vide , ajouter un produit avant la suppression');
        }
        $qty=$produit->qty;
        $prix=$produit->price;
        $id_produit=$produit->id_produit;
        $taille=$produit->taille;
        $id_commande=$produit->id_commande;
        $produit->delete();


        /****Modifier stock produit***/
        $product=produit::with('attributes')->find($id_produit);
        if ($taille != 0) {
            foreach ($product->attributes as $pa) {
                if ($pa->taille == $taille) {
                    $pa->stock+=$qty;
                    $pa->update();
                }
            }
        }
        $product->total_stock+=$qty;
        

        /***Si le produit est un pack modifier le stock du produit du pack */
            //produit=(table produit) qui arrive a travers la table produit commander
            //packproduct=(table pack_produit) les produits de cet pack
            //prodpack=(produit) qui arrive à travers la table produit pack
            if($product->type == "pack"){
                $packproduct=pack_produit::where('id_pack','=',$product->id)->get();
                foreach($packproduct as $ppro){
                    $prodpack=produit::find($ppro->prod_id);
                    $prodpack->total_stock=$prodpack->total_stock+$ppro->qty;
                    $prodpack->update();
                    if($ppro->taille != "0"){
                        $attribut=attributproduit::where(['prod_id'=>$ppro->prod_id , 'taille'=>$ppro->prod_taille])->first();
                        $attribut->stock+=$ppro->qty;
                        $attribut->update();
                    }
                }
            }
        /****Fin travail stock pack */
        $product->update();
        /*****Fin modification stock*****/


        /****Modifier total commande****/
        $commande=commande::find($id_commande);
        $total=$commande->total-$qty*$prix;

        $net=0;
        if ($commande->promo > 0) {
            if ($commande->type_promo == "Fixe") {
                $net=$total-$commande->promo;
            }

            if ($commande->type_promo == "Pourcentage") {
                $pourcentage=($commande->promo/$commande->total)*100;
                $promo=$total*$pourcentage/100;
                $commande->promo=$promo;
                $net=$total-$promo;
            }
        }
        $commande->total=$total;
        $commande->net=$net;
        $commande->update();
        /****Fin modification total commande****/

        return back();
    }



    /****Générer code commande */
    private function generateCode()
    {
        $ch='0123456789';
        $code='VIORE-';
        for ($i=0; $i < 3; $i++) {
            $r=rand(0, 9);
            $code.=$ch[$r];
        }
        $countCode=commande::where('code_commande', '=', $code)->count();
        if ($countCode != 0) {
            return generateCode();
        } else {
            return $code;
        }
    }


    public function Export20CommandePdf()
    {
        $today=date('Y-m-d');
        $commande=commande::orderBy('id', 'desc')->where('date', '=', $today)->get();
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
            
            <th>Client</th>
            <th>Téléphone</th>
            <th>Région</th>
            <th>Ville</th>
            <th>État</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        
      ';
        foreach ($commande as $c) {
            $html.='
            <tr>
                            
                                          
                            <td>
                                 <p>'.$c->nomclient.'</p>
                            </td>
                                         
                                          
                                         

                            <td>
                                <p>'.$c->tel.'</p>
                            </td>

                                          

                            <td>
                               <p>'.$c->region.'</p>
                            </td>
                            <td>
                                <p>'.$c->ville.'</p>
                            </td>

                            <td>
                                <p>'.$c->etat.'</p>
                            </td>

                            <td>
                                <p>'.$c->total.'</p>
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
        return $pdf->setPaper('a4', 'landscape')->stream('commande'.$today.'.pdf');
    }
}
