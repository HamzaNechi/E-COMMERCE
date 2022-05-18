<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\categorie;
use App\produit;
use App\attributproduit;
use App\wishlist;
use App\Coupon;
use App\cart;
use Session;
use DB;
class WishlistController extends Controller
{
    public function get_element_for_page(){
    	$session_id=Session::get('session_id');
    	$wishlist=wishlist::where('session_id','=',$session_id)->get();
       $cat=categorie::where('parent_id','=',0)->get();
       $categorie=categorie::all();
        $cat_dropdown="<option>Catégorie</option>";
        foreach ($cat as $c) {
            $cat_dropdown.="<option value='".$c->id."'>".$c->nom."</option>";
            $subcat=categorie::where('parent_id','=',$c->id)->get();
            foreach ($subcat as $sub) {
                $cat_dropdown.="<option value='".$sub->id."'>&nbsp;--&nbsp;".$sub->nom."</option>";
            }
        }
        
        /**debut cart icon page**/
        $session_id=Session::get('session_id');
        $cart_icon=cart::where('session_id','=',$session_id)->get();
        $product_cart=produit::all();
        /**fin cart icon page**/
        return view('vitrine.wishlist')->with(
            array(
                'cat_dropdown'=> $cat_dropdown,
                'wishlist'=>$wishlist,
                
                'product_cart'=>$product_cart,
                'cart_icon'=>$cart_icon,
                'categorie'=>$categorie,
                
            )
        );
    }

    public function add_to_wishlist($id){
        $session_id=Session::get('session_id');
        if (empty($session_id)) {
            $session_id=str_random(40);
            Session::put('session_id',$session_id);
        }
        $product =produit::find($id);
        $add_wishlist=new wishlist();
        $add_wishlist->prod_id=$product->id;
        $add_wishlist->prod_nom=$product->nom;
        $add_wishlist->prod_code=$product->code;
        $add_wishlist->prod_couleur=$product->couleur;
        $add_wishlist->prix=$product->prix;
        $add_wishlist->session_id=$session_id;
        $count=wishlist::where(['prod_code'=>$product->code ,'session_id'=>$session_id])->count();
        if ($count > 0) {
            return back()->with('flash_message_error','Le produit est déjà dans la liste de souhaits');
        }else{
           $add_wishlist->save();
            return back()->with('flash_message_success','Le produit est ajouté à la liste de souhaits'); 
        }
        
    }

    public function Delete_product_to_wishlist($id){
        $wishlist=wishlist::find($id);
        $wishlist->delete();
        return back();
    }


    
}
