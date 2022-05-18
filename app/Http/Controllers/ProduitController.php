<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\produit;
use App\categorie;
use App\image_produit;
use Image;
use App\attributproduit;
use App\pack_produit;
use Session;

class ProduitController extends Controller
{
    /*****Retourner les éléments au page ajouter produit (la liste des produits , les catégories , les pack_produit) */
    public function categorie_id(){

        /****Catégorie**/
    	$cat=categorie::where('parent_id','=',0)->get();
    	$cat_dropdown="";
    	foreach ($cat as $c) {
    		$cat_dropdown.="<option value='".$c->id."'>".$c->nom."</option>";
    		$subcat=categorie::where('parent_id','=',$c->id)->get();
    		foreach ($subcat as $sub) {
    			$cat_dropdown.="<option value='".$sub->id."'>&nbsp;--&nbsp;".$sub->nom."</option>";
    		}
    	}
        /****Fin Catégorie****/



        /****Produit******/
        $produit=produit::where('type','=','produit')->get();
        /****Fin produit *****/


        /****produit du pack***/
        $session_id=Session::get('session_id');
        $produits=pack_produit::where(['id_pack'=>0,'session_id'=>$session_id])->get();
        if (sizeof($produits)==0) {
            $produits=NULL;
        }
        //***fin produit pack****/
    	return view('dashboard.ajout_produit')->with(
    		array(
    			'cat_dropdown'=> $cat_dropdown,
                'produit'=>$produit,
                'produits'=>$produits,
    		)
    	);
    }


    public function addproduct(Request $request){
        //echo $request->total_stock;die;
        $session_id=Session::get('session_id');

        /****Si le produit est un pack il faut que le pack n'est pas vide minimum 2 produit */
        if ($request->type_product =="pack") {
            $count_product=pack_produit::where(['id_pack'=>0,'session_id'=>$session_id])->count();
            if($count_product < 2){
                return back()->with('flash_message_error','Le pack est vide ou il y a un seule produit dans le pack');
            }
        }
        /***End test vide pack */
    	if( $request->hasFile('image')){
            $image_tmp=Input::file('image');
            if($image_tmp->isValid()){
               $extension =$image_tmp->getClientOriginalExtension();
               
               $filename=rand(111,999).'.'.$extension;
               $large_image_path='img/produit/l/'.$filename;
               $medium_image_path='img/produit/m/'.$filename;
               $small_image_path='img/produit/s/'.$filename;
               //Resize Images
               Image::make($image_tmp)->resize(1000,1200)->save($large_image_path);
               Image::make($image_tmp)->resize(370,445)->save($medium_image_path);
               Image::make($image_tmp)->resize(70,84)->save($small_image_path);

            }
            if($request->couleur != ""){
                $couleur=$request->couleur;
            }else{
                $couleur="";
            }
            $product=new produit([
            	'cat_id'=>$request->cat_id,
            	'nom'=>$request->nom,
            	'code'=>$request->code,
            	'couleur'=>$couleur,
            	'description'=>$request->description,
            	'prix'=>$request->prix,
                'prix_gros'=>$request->prix_gros,
            	'image'=>$filename,
                'total_stock'=>$request->total_stock,
                'type'=>$request->type_product,
            ]);
            $product->save();
        }

        
        if ($request->type_product =="pack") {
            $last_product=produit::latest()->first();
            $id_last=$last_product->id;

            $pack_product=pack_produit::where(['id_pack'=>0,'session_id'=>$session_id])->get();
            foreach ($pack_product as $pk) {
                $pk->id_pack=$id_last;
                $pk->update();
            }
            return redirect('/Pack/Voir_Packs')->with('flash_message_success','Pack ajouté avec succé');
        }else{
            return redirect('/ViewProduit')->with('flash_message_success','Produit ajouter avec succés');
        }
        
    }

    public function viewProduct(){
        $product=produit::where('type','=','produit')->orderBy('id','DESC')->paginate(20);
        $pack=NULL;
        return view('dashboard.produit')->with(
            array(
                'product' => $product,
                'pack'=>$pack,
            )
        );
    }

    public function viewProductDetail($id){
        $detail=produit::where('id','=',$id)->get();
        $attribute=attributproduit::where('prod_id','=',$id)->get();
        $produit_pack=NULL;
        $pack=NULL;
        return view('dashboard.detailproduit')->with(
            array(
                'detail'=>$detail,
                'attribute'=>$attribute,
                'produit_pack'=>$produit_pack,
                'pack'=>$pack,
            )
        );
    }

    public function editProduct(Request $request, $id){
        if ($request->isMethod('post')) {
            $couleur="";
            if($request->couleur != NULL){
                $couleur=$request->couleur;
            }
            if( $request->hasFile('image')){
                $image_tmp=Input::file('image');
                if($image_tmp->isValid()){
                    $extension =$image_tmp->getClientOriginalExtension();
                    $filename=rand(111,999).'.'.$extension;
                    $large_image_path='img/produit/l/'.$filename;
                    $medium_image_path='img/produit/m/'.$filename;
                    $small_image_path='img/produit/s/'.$filename;
                    //Resize Images
                    Image::make($image_tmp)->resize(1000,1200)->save($large_image_path);
                    Image::make($image_tmp)->resize(370,445)->save($medium_image_path);
                    Image::make($image_tmp)->resize(70,84)->save($small_image_path);
                }

                $produit=produit::find($id);
                //Delete image from folder
                if (file_exists($large_image_path.$produit->image)) {
                    unlink($large_image_path.$produit->image);
                }

                if (file_exists($medium_image_path.$produit->image)) {
                    unlink($medium_image_path.$produit->image);
                }

                if (file_exists($small_image_path.$produit->image)) {
                    unlink($small_image_path.$produit->image);
                }
                
                $produit->cat_id=$request->cat_id;
                $produit->nom=$request->nom;
                $produit->code=$request->code;
                $produit->couleur=$couleur;
                $produit->description=$request->description;
                $produit->prix=$request->prix;
                $produit->prix_gros=$request->prix_gros;
                $produit->image=$filename;
                $produit->total_stock=$request->total_stock;
                $produit->update();
            }else{
                $produit=produit::find($id);
                $produit->cat_id=$request->cat_id;
                $produit->nom=$request->nom;
                $produit->code=$request->code;
                $produit->couleur=$couleur;
                $produit->description=$request->description;
                $produit->prix=$request->prix;
                $produit->prix_gros=$request->prix_gros;
                $produit->total_stock=$request->total_stock;
                $produit->update();
            }
            return redirect('/ViewProduit')->with('flash_message_success','Produit modifier avec succés');
        }
        $productDetail=produit::find($id);
        //Catégorie dropdown start
        $cat=categorie::where('parent_id','=',0)->get();
        $cat_dropdown="<option disabled>Choisir une catégorie</option>";
        foreach ($cat as $c) {
            if($c->id==$productDetail->cat_id){
                $selected="selected";
            }else{
                $selected ="";
            }
            $cat_dropdown.="<option value='".$c->id."' ".$selected.">".$c->nom."</option>";
            $subcat=categorie::where('parent_id','=',$c->id)->get();
            foreach ($subcat as $sub) {
                if($sub->id==$productDetail->cat_id){
                $selected="selected";
                }else{
                    $selected ="";
                }
                $cat_dropdown.="<option value='".$sub->id."' ".$selected.">&nbsp;--&nbsp;".$sub->nom."</option>";
            }
        }
        //end catégorie dropdown
        return view('dashboard.edit-product')->with(
            array(
                'productDetail'=>$productDetail,
                'cat_dropdown'=>$cat_dropdown,
            )
        );
    }


    public function search(Request $request){
        $name=$request->get('recherche');
        $product=produit::where('nom','like','%'.$name.'%')->get();
        if ($product != NULL) {
            return view('dashboard.produit')->with(
            array(
                'product' => $product,
            )
         );
        }
        else{
            return back();
        }
        
    }


    public function AddAttribute(Request $request,$id){
        $productDetails=produit::with('attributes')->where(['id'=>$id])->first();
        if ($request->isMethod('post')) {
            $data=$request->all();
            foreach ($data['sku'] as $key => $val) {
                if (!empty($val)) {
                    $attribute=new attributproduit;
                    $attribute->prod_id=$id;
                    $attribute->sku=$val;
                    $attribute->taille=$data['taille'][$key];
                    $attribute->prix_at=$data['prix_at'][$key];
                    $attribute->stock=$data['stock'][$key];
                    $attribute->prix_gros=$data['prix_gros'][$key];
                    $attribute->save();
                }
            }
            $productDetails->total_stock=attributproduit::where('prod_id','=',$id)->sum('stock');
            $productDetails->update();
            return redirect('/Admin/DetailProduit/'.$id)->with('flash_message_success','Les attributs ajoutés avec succés');
        }
        return view('dashboard.add_attributes')->with(compact('productDetails'));
    }


    /**ajouter des images au produits**/
    public function AddImage(Request $request,$id){
        $productDetails=produit::with('attributes')->where(['id'=>$id])->first();
        if ($request->isMethod('post')) {
            if( $request->hasFile('images')){
                $image_tmp=Input::file('images');
                $extension =$image_tmp->getClientOriginalExtension();
               
               $filename=rand(1111,9999).'.'.$extension;
               
               $large_image_path='img/produit/l/'.$filename;
               $medium_image_path='img/produit/m/'.$filename;
               $small_image_path='img/produit/s/'.$filename;
               //Resize Images
               Image::make($image_tmp)->resize(1000,1200)->save($large_image_path);
               Image::make($image_tmp)->resize(370,445)->save($medium_image_path);
               Image::make($image_tmp)->resize(70,84)->save($small_image_path);

               $image_produit=new image_produit();
               $image_produit->id_produit=$request->prod_id;
               $image_produit->image=$filename;
               $image_produit->save();
               return back()->with('flash_message_success',"L'image a été ajouté");
            }else{
                echo " not image";
            }
            
        }else{
            $images=image_produit::where('id_produit','=',$id)->get();
            return view('dashboard.add_image')->with(compact('images','productDetails'));
        }
        
    }

    public function destroy_image($id){
        $image=image_produit::find($id);
        $large_image_path='img/produit/l/';
        $medium_image_path='img/produit/m/';
        $small_image_path='img/produit/s/';
        if (file_exists($large_image_path.$image->image))
        {
            unlink($large_image_path.$image->image);
        }

        if (file_exists($medium_image_path.$image->image))
        {
            unlink($medium_image_path.$image->image);
        }

        if (file_exists($small_image_path.$image->image))
        {
            unlink($small_image_path.$image->image);
        }

        $image->delete();
        return back()->with('flash_message_success',"L'image est supprimé");
    }


    public function destroy(Request $request){
        $id=$request->get('produit');
        $product=produit::find($id);
        //Get product image path
        $large_image_path='img/produit/l/';
        $medium_image_path='img/produit/m/';
        $small_image_path='img/produit/s/';

        //Delete image from folder
        if (file_exists($large_image_path.$product->image)) {
            unlink($large_image_path.$product->image);
        }

        if (file_exists($medium_image_path.$product->image)) {
            unlink($medium_image_path.$product->image);
        }

        if (file_exists($small_image_path.$product->image)) {
            unlink($small_image_path.$product->image);
        }
        $attribut=attributproduit::where('prod_id','=',$id)->get();
        foreach ($attribut as $key) {
            $att=attributproduit::find($key->id);
            $att->delete();
        }
        $product->delete();
        return back()->with('flash_message_success','Le produit a été supprimé');
        
    }

    public function destroyAtt(Request $request){
        $id=$request->get('id_attribut');
        $attribut=attributproduit::find($id);
        $stock=$attribut->stock;
        $id_prod=$attribut->prod_id;
        $attribut->delete();
        $product=produit::find($id_prod);
        $product->total_stock-=$stock;
        $product->update();
        return back()->with('flash_message_success',"L'attribut a été supprimé");
    }

    public function editAttribut(Request $request,$id){
        if ($request->isMethod('post')) {
            $data=$request->all();
           // echo "<pre>";print_r($data);die;
            $att=attributproduit::find($id);
            $id_prod=$att->prod_id;
            $att->sku=$data['sku'];
            $att->stock=$data['stock'];
            $att->taille=$data['taille'];
            $att->prix_at=$data['prix'];
            $att->prix_gros=$data['prix_gros'];
            $att->update();
            //Modifier total stock de produit
            $sum_stock=attributproduit::where('prod_id','=',$id_prod)->sum('stock');
            $produit=produit::find($att->prod_id);
            $produit->total_stock=$sum_stock;
            $produit->update();
          return redirect('/Admin/DetailProduit/'.$id_prod)->with('flash_message_success','Attribut modifier avec succés');  
        }else{
            $attribut=attributproduit::find($id);
            return view('dashboard.modifier_attribut')->with(array('attribut'=>$attribut));
        }
    }


    /****Return produit to page pack personnalisé*****/
    public function packProducts($id)
    {
        $productsAll = produit::with('attributes')->where(['cat_id' => $id])->get();
        return $productsAll;
    }
}
