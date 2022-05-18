<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\devis;
use App\produit_devis;
use App\fournisseur;
use App\User;
use App\produit;
use App\attributproduit;
use App\pack_produit;
use Auth;
use DB;
use Dompdf\Dompdf;
use Session;


class DevisController extends Controller
{

  /****Devis de fournisseur affiché dans son espace */
  public function index(){
    $id_user=Auth::user()->id;
    $fournisseur=fournisseur::where('id_user','=',$id_user)->get();
    $id=0;
    foreach ($fournisseur as $k) {
      $id=$k->id;
    }
    $devis=devis::where('fournisseur_id','=',$id)->orderBy('id','DESC')->get();
    return view('dashboard.fournisseur.devisfournisseur')->with(array( 'devis'=>$devis, ));
  }

  /***Les devis affichés dans l'espace admin */
  public function index2(){
    $devis=devis::where('fournisseur_id','>',0)->orderBy('id','DESC')->paginate(20);
    return view('dashboard.devis')->with(array('devis' => $devis,));
  }

  /****Afficher produit séléctionner dans la page demander devis(espace fournisseur)*****/
  public function Get_Element_Devis(){
      $produit_dropdown=produit::all();
      $session_id=Session::get('session_id');
      $produits=produit_devis::where('session_id','=',$session_id)->get();
      return view('dashboard.fournisseur.demandeDevis')->with(array(
        'produit_dropdown'=>$produit_dropdown,
        'produits'=>$produits,
      ));
  }

  public function search(Request $request){
      $data=$request->recherche;
      $devis=devis::where('client','like','%'.$data.'%')->get();
      if($devis != NULL){
        return view('dashboard.devis')->with(array(
          'devis'=>$devis,
        ));
      }
      else{
        return view('dashboard.devis');
      }
  }

  public function destroy(Request $request){
      $id=$request->devis_id;
      /******Supprimer produit devis du table produit_devis*****/
      $pd=produit_devis::where('id_devis','=',$id)->get();
      foreach ($pd as $k) {
        $k->delete();
      }
      /******Supprimer devis***/
      $devis=devis::find($id);
      $devis->delete();
      return back()->with('flash_message_success','La devis est supprimé');
  }

/**Les devis personnalisé affiché dans l'espace admin */
  public function get_devis_personal(){
        $devis=devis::where('fournisseur_id','=',0)->orderBy('id','DESC')->paginate(20);
        return view('dashboard.devis')->with(array(
            'devis'=>$devis,
        ));
  }

  public function PapperDevis($id){
        $devis=devis::find($id);
        $produit=produit::all();
        $produit_pack=pack_produit::all();
        $produits=produit_devis::where('id_devis','=',$id)->get();
        return view('dashboard.detaildevispersonnel')->with(array(
            'devis'=>$devis,
            'produits'=>$produits,
            'produit'=>$produit,
            'produit_pack'=>$produit_pack,
        ));
  }

  public function detailDevis($id){
      $devis=devis::find($id);
      $produit=produit::all();
      $produit_pack=pack_produit::all();
      $produits=produit_devis::where('id_devis','=',$id)->get();
      return view('dashboard.detaildevis')->with(array(
        'devis'=>$devis,
        'produits'=>$produits,
        'produit'=>$produit,
        'produit_pack'=>$produit_pack,
      ));
  }


  public function DeleteAllSelected(Request $request){
        $data=$request->all();
        foreach ($data['all'] as $tous => $val) {
            $devis=devis::find($val);
            $produit_devis=produit_devis::where('id_devis','=',$devis->id)->get();
            foreach ($produit_devis as $pd) {
                $pd->delete();
            }
            $devis->delete();
        }
        return back()->with('flash_message_success','Les devis supprimés');
  }


  public function ImprimerDevisPdf($id){
    echo $id;
  }

  public function AddproductInUpdateDevis(Request $request,$id){
      $data=$request->all();
      $produit=produit::with('attributes')->find($data['id_produit']);
      $total=0;
      if ($data['size'] > 0) {
        $attribut=attributproduit::find($data['size']);
        $prod_dev=produit_devis::where(['id_devis'=>$id , 'taille'=>$attribut->taille ,'id_produit'=>$produit->id])->get();
      }else{
        $prod_dev=produit_devis::where(['id_devis'=>$id, 'id_produit'=>$produit->id])->get();
      }
      if (sizeof($prod_dev) == 0) {
        $produits= new produit_devis();
        $produits->nom_produit=$produit->nom;
        $produits->qty=$data['qty'];
      if ($data['size'] > 0) {
        $produits->prix=$attribut->prix_at;
        $produits->total=$attribut->prix_at*$data['qty'];
        $produits->taille=$attribut->taille;
      }else{
        $produits->prix=$produit->prix;
        $produits->total=$produit->prix*$data['qty'];
        $produits->taille=0;
      }
      $produits->id_devis=$id;
      $produits->id_produit=$data['id_produit'];
      $produits->save();

      /*********Modifier total ********/
        $total=produit_devis::where('id_devis','=',$id)->sum('total');
        $devis=devis::find($id);
        $devis->total_ht=$total;
        if ($devis->tva != 0) {
          $devis->total_ttc=$devis->total_ht+$devis->total_ht*$devis->tva/100;
          $devis->net=$devis->total_ttc;
        }else{
          $devis->total_ttc=$total;
          $devis->net=$total;
        }
        $devis->update();
      /******Fin modifier total *******/
      return back()->with('flash_message_success','Produit ajouté avec succée');
      }else{
        return back()->with('flash_message_error','Le produit est déjà existe');
      }
  }

  /****Ajouter produit avec session ***/
  public function AjouterProduitDevis(Request $request){
      $session_id=Session::get('session_id');
      if (empty($session_id)) {
        $session_id=str_random(40);
        Session::put('session_id',$session_id);
      }

      $data=$request->all();
      $produits=new produit_devis();
      $produits->id_devis=0;
      $produits->nom_produit=$data['prod_nom'];
      $produits->qty=$data['qty'];
      $produits->id_produit=$data['id_produit'];
      if ($data['size'] != 0) {
        $sizeArr=explode("-", $data['size']);
        $prix=$sizeArr[0];
        $taille=$sizeArr[1];
      }else{
        $prix=$data['prod_prix'];
        $taille=0;
      }
      $produits->prix=$prix;
      $produits->taille=$taille;
      $produits->total=$prix*$data['qty'];
      $produits->session_id=$session_id;
      $produits->save();

      return back()->with('flash_message_success','Produit ajouté avec succée');
  }


  public function Add_devis(){
      $session_id=Session::get('session_id');
      $NewDevis=new devis();
      $NewDevis->client="";
      $NewDevis->tel="";
      $NewDevis->ville="";
      $NewDevis->region="";
      $NewDevis->adresse="";
      $NewDevis->postal="";
      $NewDevis->fournisseur_id=0;
      $NewDevis->net=0;
      $NewDevis->tva=0;
      $NewDevis->timbre=0;
      $NewDevis->total_ht=0;
      $NewDevis->date="1111-11-11";
      $NewDevis->total_ttc=0;
      $NewDevis->save();
      $devis=devis::latest()->first();
      $produitdevis=produit_devis::where('session_id','=',$session_id)->get();
      foreach ($produitdevis as $key) {
        $key->id_devis=$devis->id;
        $key->update();
      }
      $id=Auth::user()->id;
      $fournisseur=fournisseur::where('id_user','=',$id)->get();
        $ttc=produit_devis::where('id_devis','=',$devis->id)->sum('total');
        $devis->client=Auth::user()->name;
        $devis->tel=Auth::user()->tel;
        foreach ($fournisseur as $k) {
        $devis->region=$k->region;
          $devis->ville=$k->ville;
          $devis->adresse=$k->adresse;
          $devis->postal=$k->postal;
          $devis->fournisseur_id=$k->id;
          }
          $devis->net=$ttc;
          $devis->total_ht=$ttc;
          $today = date("Y-m-d");
          $devis->date=$today;
          $devis->total_ttc=$ttc;
          $devis->update();
          Session::forget('session_id');
          if(Auth::user()->role == 2){
            return redirect('/DevisFournisseur')->with('flash_message_success','Devis ajouté');
          }else{
            return back()->with('flash_message_success','Devis ajouté');
          }
          
  }


  public function DeleteProduct($id){
      $produit=produit_devis::find($id);
      if ($produit->id_devis == 0) {
        $produit->delete();
      }else{
        $id_devis=$produit->id_devis;
        $produit->delete();
        //Modifier total devis
        $total=produit_devis::where('id_devis','=',$id_devis)->sum('total');
        $devis=devis::find($id_devis);
        $devis->total_ht=$total;
        if ($devis->tva != 0) {
          $ttc=$total+$total*$devis->tva/100;
          $net=$ttc;
        }else{
          $ttc=$total;
          $net=$total;
        }

        $devis->total_ttc=$ttc;
        $devis->net=$net;
        $devis->update();
      }
      
      return back()->with('flash_message_success','Le produit est supprimé');
  }


  public function DevisPersonnel(){
        $session_id=Session::get('session_id');
        $produit=produit::with('attributes')->get();
        $produits=produit_devis::where('session_id','=',$session_id)->get();
         
        return view('dashboard.ajouter_devis_manuel')->with(array(
            'produit'=>$produit,
            'produits'=>$produits,
        ));
  }

  public function AddDevisPersonnel(Request $request){
        $session_id=Session::get('session_id');
        $data=$request->all();
        $NewDevis=new devis();
        $NewDevis->client="";
        $NewDevis->tel="";
        $NewDevis->ville="";
        $NewDevis->region="";
        $NewDevis->adresse="";
        $NewDevis->postal="";
        $NewDevis->fournisseur_id=0;
        $NewDevis->net=0;
        $NewDevis->tva=0;
        $NewDevis->timbre=0;
        $NewDevis->total_ht=0;
        $NewDevis->date="1111-11-11";
        $NewDevis->total_ttc=0;
        $NewDevis->save();
        $id_devis=DB::getPdo()->lastInsertId();
        //echo $id_devis;die;
        $devis=devis::find($id_devis);
        /***Ajouter id devis au produit_devis***/
        $product=produit_devis::where('session_id','=',$session_id)->get();
        $total=0;
        foreach ($product as $v) {
          $v->id_devis=$devis->id;
          $v->update();
          $total+=$v->total;
        }
        $devis->client=$data['nom'];
        $devis->tel=$data['tel'];
        $devis->region=$data['region'];
        $devis->ville=$data['ville'];
        $devis->adresse=$data['adresse'];
        $devis->postal=$data['postal'];
        $devis->date=$data['date'];
        $devis->tva=$data['tva'];
        $devis->timbre=$data['timbre'];
        /***Ajouter total , net , ..*****/
        $devis->total_ht=$total;
        if ($data['tva'] > 0) {
          $ttc=$total+($total*$data['tva']/100)+$data['timbre'];//(tva + timbre)
          $devis->net=$ttc;
          $devis->total_ttc=$ttc;
        }else{
          $devis->net=$total;
          $devis->total_ttc=$total;
        }
        $devis->update();
        //echo"<pre>";print_r($devis);die;
        Session::forget('session_id');
        return redirect('/DevisManuel/Devis')->with('flash_message_success','Devis ajouté');
          
  }



  public function UpdateDevisPersonnel(Request $request,$id){
        if ($request->isMethod('post')) {
            $data=$request->all();
            $devis=devis::find($id);
            $devis->client=$data['nom'];
            $devis->tel=$data['tel'];
            $devis->region=$data['region'];
            $devis->ville=$data['ville'];
            $devis->adresse=$data['adresse'];
            $devis->postal=$data['postal'];
            $devis->date=$data['date'];
            $devis->tva=$data['tva'];
            $devis->timbre=$data['timbre'];
            $devis->update();

            $s=produit_devis::where('id_devis','=',$devis->id)->sum('total');
            $devis->total_ht=$s;
            if ($data['tva'] != 0) {
                $devis->total_ttc=$s+($s*$devis->tva/100)+$devis->timbre;
                $devis->net=$devis->total_ttc;
            }else{
                $devis->total_ttc=$s;
                $devis->net=$devis->total_ttc;
            }
            $devis->update();
            return redirect('/Devis')->with('flash_message_success','La devis est bien modifié');
        }else{
            $devis=devis::find($id);
            $produits=produit_devis::where('id_devis','=',$id)->get();
            $produit=produit::with('attributes')->get();
            return view('dashboard.UpdateDevisPersonnel')->with(array(
                'devis'=>$devis,
                'produits'=>$produits,
                'produit'=>$produit,
            ));
        }
  }



  public function Export20DevisPdf(){
    $devis=devis::orderBy('id','DESC')->take(20)->get();
    $today=date('Y-m-d');
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
      foreach ($devis as $d) {
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
        return $pdf->setPaper('a4','landscape')->stream('Devis'.$today.'.pdf');
    }
   
}
