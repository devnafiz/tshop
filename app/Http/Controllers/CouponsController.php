<?php

namespace App\Http\Controllers;
use App\Coupon;

use Illuminate\Http\Request;

class CouponsController extends Controller
{
     public function addCoupon(Request $request)
     {
     	 if($request->isMethod('post')){

     	 	$data=$request->all();
     	 	//echo"<pre>";print_r($data);die;
     	 	$coupons = new Coupon;

     	 	$coupons->coupons=$data['coupons'];
     	 	$coupons->amount=$data['amount'];
     	 	$coupons->amount_type=$data['amount_type'];
     	 	$coupons->expiry_date=$data['expiry_date'];
     	 	$coupons->status= $data['status'];
     	 	$coupons->save();
     	 	return redirect()->action('CouponsController@viewCoupons')->with('flash_message','Successfully add coupons');
     	 }

     	 return view('admin.coupons.add_coupon');
     }

     public function editCoupon(Request $request, $id=null){
     	if($request->isMethod('post')){

     		$data=$request->all();
     		$coupons = Coupon::find($id);

     	 	$coupons->coupons=$data['coupons'];
     	 	$coupons->amount=$data['amount'];
     	 	$coupons->amount_type=$data['amount_type'];
     	 	$coupons->expiry_date=$data['expiry_date'];
     	 	if(empty($data['status'])){
     	 		$data['status']=0;
     	 	}
     	 	$coupons->status= $data['status'];
     	 	$coupons->save();
     	 	return redirect()->action('CouponsController@viewCoupons')->with('flash_message','Successfully edit coupons');

     	}
       $couponDetails=Coupon::find($id);

       // $couponDetails =json_decode(json_encode($couponDetails));

       // echo "<pre>";print_r($couponDetails);die;
       return view('admin.coupons.edit_coupon')->with(compact('couponDetails'));

     }
     public function deleteCoupon($id=null)
     {
     	Coupon::where(['id'=>$id])->delete();
     	return redirect()->back()->with('flash_message','Successfully coupon delete');
     }

     public function viewCoupons()
     {
     	$coupons=Coupon::get();
     	 return view('admin.coupons.view_coupons')->with(compact('coupons'));
     }
}
