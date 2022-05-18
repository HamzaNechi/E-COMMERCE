<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Coupon;

class CouponController extends Controller
{
    public function addCoupon(Request $request){
    		$data=$request->all();
    		//echo "<pre>";print_r($data);die;
    		$today = date("Y-m-d");
    		if ($data['date'] >$today) {
    			$coupon=new Coupon();
	    		$coupon->coupon_code=$data['coupon_code'];
	    		$coupon->montant=$data['montant'];
	    		$coupon->montant_type=$data['type'];
	    		$coupon->date_expiration=$data['date'];
	    		$coupon->statut=$data['status'];
				$coupon->save();
	    		return redirect('/AfficheCoupon')->with('flash_message_success','Le code promo est ajouté');
    		}
    		else{
    			return back()->with('flash_message_error',"Verifier la date d'expiration");
    		}
    		
    	
    }


    public function affiche_coupon(){
    	$coupon=Coupon::paginate(20);
    	return view('dashboard.codepromo')->with(array(
    		'coupon' => $coupon,
    	));
    }


    public function destroy(Request $request){
        $id=$request->get('code_id');
    	$coupon=Coupon::find($id);
    	$coupon->delete();
    	return back()->with('flash_message_success','Le code promo a été supprimé');
    }

    public function search(Request $request){
        $name=$request->get('recherche');
        $coupon=Coupon::where('coupon_code','like','%'.$name.'%')->get();
        if ($coupon != NULL) {
            return view('dashboard.codepromo')->with(array(
            'coupon' => $coupon,
            ));
        }
        else{
            return back();
        }
        
    }

    public function updatecode(Request $request,$id){
    	$data=$request->all();
    	if ($request->isMethod('post')) {
    			$coupon=Coupon::find($id);
	    		$coupon->coupon_code=$data['coupon_code'];
	    		$coupon->montant=$data['montant'];
	    		$coupon->montant_type=$data['type'];
	    		$coupon->date_expiration=$data['date'];
	    		$coupon->statut=$data['status'];
				$coupon->update();
	    		return redirect('/AfficheCoupon')->with('flash_message_success','Le code promo est modifié');
    	}
    	$getCode=Coupon::find($id);
    	return view('dashboard.updateCoupon')->with(array(
    		'getCode'=>$getCode,
    	));
    }

}
