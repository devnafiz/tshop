<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use App\Product;
use App\Category;
use Session;
use App\ProductImages;
use Auth;
use App\ProductAttributes;
use App\Coupon;
use DB;
use App\User;
use App\Country;
use App\DeliveryAddress;
use App\Order;
use App\OrderProduct;

class productController extends Controller
{
    public function addProduct(Request $request){

    	if($request->isMethod('post')){

    		$data= $request->all();
    		if(empty($data['category_id'])){
    			return redirect()->back()->with('flash_message','Product category has been missing');
    		}
    		$product = new Product;

    		$product->product_name =$data['product_name'];
    		$product->category_id =$data['category_id'];
    		$product->product_color =$data['product_color'];
    		$product->product_code =$data['product_code'];
    		if(!empty($data['description'])){
    			$product->description =$data['description'];
    		}else{
    			$product->description ='';
    		}
    		if(!empty($data['care'])){
    			$product->care =$data['care'];
    		}else{
    			$product->care ='';
    		}
    		
    		$product->price =$data['price'];
    		if($request->hasFile('image')){
    			$image_tmp =Input::file('image');
    			if($image_tmp->isValid()){
    				$extension =$image_tmp->getClientOriginalExtension();
    				$filename = rand(111,99999).'.'.$extension;
    				$large_image_path ='images/backend_image/products/large/'.$filename;
    				$medium_image_path ='images/backend_image/products/medium/'.$filename;
    				$small_image_path ='images/backend_image/products/small/'.$filename;
    				Image::make($image_tmp)->save($large_image_path);
    				Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
    				Image::make($image_tmp)->resize(300,300)->save($small_image_path);
    				//store image
    				$product->image =$filename;

    			}

    		}
    		if(empty($data['status'])){
                $status=0;

            }else{
                $status=1;
            }
    		$product->status=$status;
    		$product->save();
    		return redirect()->back()->with('flash_message','Product has been added successfully');
    	}
    	$levels =Category::where(['parent_id'=>0])->get();
    	$category_dropdown ="<option selected disables>Select</option>";

    	foreach ($levels as $cat) {
    	    $category_dropdown .="<option value='".$cat->id."'>".$cat->name."</option>";
    	    $sub_categories =Category::where(['parent_id'=>$cat->id])->get();
    	    foreach ($sub_categories as $sub_cat) {
    	    	$category_dropdown.="<option value='".$sub_cat->id."'>&nbsp--&nbsp".$sub_cat->name."</option>";
    	    }
    	}

    	return view('admin.products.add-product')->with(compact('category_dropdown'));

    }

    public function editProduct(Request $request, $id=null)
    {
    	if($request->isMethod('post')){
    		$data =$request->all();
    		//echo "<pre>";print_r($data);die;
    		if($request->hasFile('image')){
    			$image_tmp =Input::file('image');
    			if($image_tmp->isValid()){
    				$extension =$image_tmp->getClientOriginalExtension();
    				$filename = rand(111,99999).'.'.$extension;
    				$large_image_path ='images/backend_image/products/large/'.$filename;
    				$medium_image_path ='images/backend_image/products/medium/'.$filename;
    				$small_image_path ='images/backend_image/products/small/'.$filename;
    				Image::make($image_tmp)->save($large_image_path);
    				Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
    				Image::make($image_tmp)->resize(300,300)->save($small_image_path);
    				//store image
    				//$product->image =$filename;

    			}

    		}else{
    			$filename =$data['current_image'];
    		}
    		Product::where(['id'=>$id])->update(['category_id'=>$data['category_id'],'product_name'=>$data['product_name'],'product_code'=>$data['product_code'],'product_color'=>$data['product_color'],'description'=>$data['description'],'care'=>$data['care'],'price'=>$data['price'],'image'=>$filename,'status'=>$status]);
    		return redirect()->back()->with('flash_message','Product update successfully!');
    	}
    	$productDetails =Product::where(['id'=>$id])->first();
    	// cate gory show
    	$levels =Category::where(['parent_id'=>0])->get();
    	$category_dropdown ="<option selected disables>Select</option>";

    	foreach ($levels as $cat) {
    		if($cat->id == $productDetails->category_id){
    			$selected ="selected";

    		}else{
    			$selected ="";
    		}
    	    $category_dropdown .="<option value='".$cat->id."' ".$selected.">".$cat->name."</option>";
    	    $sub_categories =Category::where(['parent_id'=>$cat->id])->get();
    	    foreach ($sub_categories as $sub_cat) {
    	    	if($sub_cat->id == $productDetails->category_id){
                     $selected = "selected";
    	    	}else{
    	    		$selected = "";

    	    	}
    	    	$category_dropdown.="<option value='".$sub_cat->id."' ".$selected.">&nbsp--&nbsp".$sub_cat->name."</option>";
    	    }
    	}

    	return view('admin.products.edit_product')->with(compact('productDetails','category_dropdown'));
    }

    public function deleteProductImage( $id = null)
    {
        //product image name
        $productImage=Product::where(['id'=>$id])->first();

        $large_image_path='images/backend_image/products/large/';
         $medium_image_path='images/backend_image/products/medium/';
          $small_image_path='images/backend_image/products/small/';

          if(file_exists($large_image_path.$productImage->image)){
          	unlink($large_image_path.$productImage->image);
          }
          if(file_exists($medium_image_path.$productImage->image)){
          	unlink($medium_image_path.$productImage->image);
          }
          if(file_exists($small_image_path.$productImage->image)){
          	unlink($small_image_path.$productImage->image);
          }


       Product::where(['id'=>$id])->update(['image'=>'']);
       return redirect()->back()->with('flash_message','product Image has been deleted  successfully');
    }

    public function deleteAltImage($id=null){

    	$productImage=ProductImages::where(['id'=>$id])->first();

        $large_image_path='images/backend_image/products/large/';
         $medium_image_path='images/backend_image/products/medium/';
          $small_image_path='images/backend_image/products/small/';

          if(file_exists($large_image_path.$productImage->image)){
          	unlink($large_image_path.$productImage->image);
          }
          if(file_exists($medium_image_path.$productImage->image)){
          	unlink($medium_image_path.$productImage->image);
          }
          if(file_exists($small_image_path.$productImage->image)){
          	unlink($small_image_path.$productImage->image);
          }


       ProductImages::where(['id'=>$id])->delete();
       return redirect()->back()->with('flash_message','product Image has been deleted  successfully');

    }
    public function addAttributes(Request $request, $id =null)
    {
    	$productDetails=Product::with('attributes')->where(['id'=>$id])->first();
    	//$productDetails= json_decode(json_encode($productDetails));
      //echo "<pre>";print_r($productDetails); die;
      
    	if($request->isMethod('post')){
    		$data=$request->all();
    		//echo "<pre>";print_r($data);die;
    		foreach ($data['sku'] as $key => $val) {
    			if(!empty($val)){

    				//check sku duplicate
    				$attrCountSKU=ProductAttributes::where('sku',$val)->count();
    				if($attrCountSKU>0){
    					return redirect('/admin/add-attributes/'.$id)->with('flash_message','Already exist! Please another sku!');
    				}
    				// checked size duplicate
    				$attrCountSize=ProductAttributes::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
    				if($attrCountSize>0){
    					return redirect('/admin/add-attributes/'.$id)->with('flash_message','Already exist Size! Please another Size!');
    				}


    				$Attribute = new ProductAttributes;
    				$Attribute->product_id= $id;
    				$Attribute->sku =$val;
    				$Attribute->size= $data['size'][$key];
    				$Attribute->price= $data['price'][$key];
    				$Attribute->stock= $data['stock'][$key];
    				$Attribute->save();

    			}
    		}
    	}
    	return view('admin.products.add_attributes')->with(compact('productDetails'));
    }

    public function editAttributes(Request $request,$id=null){

        if($request->isMethod('post')){

            $data=$request->all();

            foreach ($data['id'] as $key => $attr) {
                ProductAttributes::where(['id'=>$data['id'][$key]])->update(['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
            }
            return redirect()->back()->with('flash_message','Product  attributes hes been updated');
            //echo "<pre>";print_r($data);die;
        }

    }
    public function addImage(Request $request, $id =null)
    {
    	$productDetails=Product::with('attributes')->where(['id'=>$id])->first();
    	//$productDetails= json_decode(json_encode($productDetails));
      //echo "<pre>";print_r($productDetails); die;
      
    	if($request->isMethod('post')){
           $data=$request->all();

        	//echo "<pre>";print_r($data); die;
           if($request->hasFile('image')){
           	$files = $request->file('image');
           	//echo "<pre>";print_r($files); die;
           	foreach($files as $file){

		            $image = new ProductImages;
		           	$extension =$file->getClientOriginalExtension();
		           	$filename=rand(111,99999).'.'.$extension;

		           	$large_image_path ='images/backend_image/products/large/'.$filename;
		    		$medium_image_path ='images/backend_image/products/medium/'.$filename;
		    		$small_image_path ='images/backend_image/products/small/'.$filename;

		    		Image::make($file)->save($large_image_path);
		    		Image::make($file)->resize(300,300)->save($medium_image_path);
		    		Image::make($file)->resize(150,150)->save($small_image_path);

		    		$image->image =$filename;
		    		$image->product_id =$data['product_id'];
		    		$image->save();
                //echo "<pre>";print_r($files); die;

           	}
           	

           	//echo "<pre>";print_r($filename); die;
           }
           return redirect('/admin/add-image/'.$id)->with('flash_message','successfully add images!');  
    		
    	}
    	$productImages=ProductImages::where(['product_id'=>$id])->get();
    	return view('admin.products.add-image')->with(compact('productDetails','productImages'));
    }

    public function deleteProduct(Request $request , $id =null)
    {

    	Product::where(['id'=>$id])->delete();
    	return redirect()->back()->with('flash_message','Producthas been delete successfully');
    }
    public function deleteAttribute( $id=null)
    {
    	ProductAttributes::where(['id'=>$id])->delete();
    	return redirect()->back()->with('flash_message','product  attributes has been delete');

    }
    public function viewProduct(Request $request)
    {
    	$products =Product::get();
    	foreach ($products as $key => $val) {
    		$category_name = Category::where(['id'=>$val->category_id])->first();
    		$products[$key]->category_name= $category_name->name;
    	}
    	return view('admin.products.view_product')->with(compact('products'));
    }

    public function products($url=null)
    {
    	$countCategory=Category::where(['url'=>$url])->count();
    	if($countCategory==0){
    		abort(404);
    		//category 
    	}
   	$categories=Category::with('categories')->where(['parent_id'=>0])->get();
    	$categoryDetails=Category::where(['url'=>$url])->first();

    	 if($categoryDetails->parent_id==0){
    	 	$subCategories=Category::where(['parent_id'=>$categoryDetails->id])->get();
            $subCategories = json_decode(json_encode($subCategories));
    	 	
    	 	foreach ($subCategories as $subcat) {
                //if(!empty($subcat->id)){
                     $cat_ids[]=$subcat->id;
               // }else{
                    //$cat_ids[]=0;
                //}
    	 		
    	 	}
    	// echo "<pre>";print_r($cat_ids);die;
           $productAll=Product::whereIn('category_id',$cat_ids)->where('status',1)->get();
           //$productAll=json_decode(json_encode($productAll));
           //echo "<pre>";print_r($productAll);die;
    	 }else{

    	 	$productAll=Product::where(['category_id'=>$categoryDetails->id])->where('status',1)->get();
    	 }
    	
    	return view('products.listing')->with(compact('productAll','categoryDetails','categories'));
    }
    public function product($id=null){
        $productsCount =Product::where(['id'=>$id,'status'=>1])->count();
        if($productsCount==0){
            abort(404);
        }
    	$productDetails=Product::with('attributes')->where('id',$id)->first();
    	$productDetails= json_decode(json_encode($productDetails));

    	// echo "<pre>";print_r($productDetails);die;

        $relatedProduct=Product::where('id','!=',$id)->where(['category_id'=>$productDetails->category_id])->get();
          //$relatedProduct=json_decode(json_encode($relatedProduct));

          //echo "<pre>";print_r($relatedProduct);die;

    		$categories=Category::with('categories')->where(['parent_id'=>0])->get();
            $altImages=ProductImages::where(['product_id'=>$id])->latest()->get();
            $total_stock=ProductAttributes::where('product_id',$id)->sum('stock');
           // $altImages=json_decode(json_encode($altImages));
           // echo "<pre>";print_r($altImages);die;
    	return view('products.details')->with(compact('productDetails','categories','altImages','total_stock','relatedProduct'));
    }

    public function getProductPrice(Request $request){
    	$data = $request->all();
    	//echo "<pre>";print_r($data);die;
    	$proArr = explode("-", $data['idSize']);
    		//echo $proArr[0];echo $proArr[1];die;
    	$productAtt =ProductAttributes::where(['product_id'=>$proArr[0],'size'=>$proArr[1]])->first();
    	echo $productAtt->price;
        echo "#";

        echo $productAtt->stock;

    }

    public function addtoCart(Request $request){

        Session::forget('couponAmount');
        Session::forget('CouponCode');
       $data=$request->all();
       if(empty(Auth::user()->email)){
         $data['user_email']='';
       }else{
        $data['user_email']=Auth::user()->email;
       }

       // if(empty($data['session_id'])){
       //   $data['session_id']='';
       // }
        $session_id=Session::get('session_id');
        if(empty($session_id)){

           $session_id =str_random(40);
            Session::put('session_id',$session_id); 
        }

       
       $sizearr = explode("-", $data['size']);
       //echo "<pre>";print_r($data);die;

       $productCount= DB::table('cart')->where(['product_id'=>$data['product_id'],'product_color'=>$data['product_color'],'size'=>$sizearr[1],'session_id'=>$session_id])->count();
       // echo $productCount;die;

       if($productCount>0){
        return redirect()->back()->with('flash_message','Product already exist cart!!');
       }else{

        $getSKU=ProductAttributes::select('sku')->where(['product_id'=>$data['product_id'],'size'=>$sizearr[1]])->first();
        DB::table('cart')->insert(['product_id'=>$data['product_id'],'product_name'=>$data['product_name'],'product_color'=>$data['product_color'],'product_code'=>$getSKU->sku,'price'=>$data['price'],'quantity'=>$data['quantity'],'size'=>$sizearr[1],'user_email'=>$data['user_email'],'session_id'=>$session_id]);
       }

        

        return redirect('/cart')->with('flash_message','successfully add to cart');

    }

    public function cart(Request $request){

        $session_id=Session::get('session_id');
        if(Auth::check()){
            $user_email=Auth::user()->email;
             $userCart =DB::table('cart')->where(['user_email'=>$user_email])->get();
        }else{
             $session_id=Session::get('session_id');
              $userCart =DB::table('cart')->where(['session_id'=>$session_id])->get();
        }
       
        foreach ($userCart as $key => $product_cart) {
            $productDetails =Product::where('id',$product_cart->product_id)->first();
            $userCart[$key]->image =$productDetails->image;
        }
        return view('products.cart')->with(compact('userCart'));
    }

     public function deleteCartProduct($id=null)
    {
        Session::forget('couponAmount');
        Session::forget('CouponCode'); 
        DB::table('cart')->where('id',$id)->delete();

        return redirect('cart')->with('flash_message','successfully cart item delete');
    }

    public function updateCartQuantity($id=null,$quantity=null)
    {
       Session::forget('couponAmount');
        Session::forget('CouponCode');
        $getCartDetails=DB::table('cart')->where('id',$id)->first();
        $getAttributeStock=ProductAttributes::where('sku',$getCartDetails->product_code)->first();
        $update_quantity=$getCartDetails->quantity+$quantity;
        if( $getAttributeStock->stock >= $update_quantity){
             DB::table('cart')->where('id',$id)->increment('quantity',$quantity);

         return redirect('cart')->with('flash_message','Update cart quantity ');

        }else{
            return redirect('cart')->with('flash_message','Required Product  quantity  arfe not Available!!');
        }
     
    }

    //checkout function
    public function checkout(Request $request){
        $user_id=Auth::user()->id;
        $user_email=Auth::user()->email;
        $userDetails=User::find($user_id);

       $countries=Country::get();

       //$BshippingDetails=DeliveryAddress::where('user_id',$user_id)->first();
       $shippinCount =DeliveryAddress::where('user_id',$user_id)->count();
        
        //echo "<pre>";print_r($shippingDetails);die;
        $shippingDetails=array();
       if($shippinCount>0){
            $shippingDetails=DeliveryAddress::where('user_id',$user_id)->first();
             //echo "<pre>";print_r($shippingDetails);die;
           }
           //update  cart table user email
           $session_id=Session::get('session_id');
           DB::table('cart')->where(['session_id'=>$session_id])->update(['user_email'=>$user_email]);


       if ($request->isMethod('post')) {
           $data=$request->all();

           
            

           
           //echo "<pre>";print_r($shippingDetails);die;
           //echo"<pre>";print_r($data);die;
           if(empty($data['billing_name'])||empty($data['billing_address'])||empty($data['billing_city'])||empty($data['billing_state'])||empty($data['billing_country'])||empty($data['billing_pincode'])||empty($data['billing_mobile'])||empty($data['shipping_name'])||empty($data['shipping_address'])||empty($data['shipping_city'])||empty($data['shipping_state'])||empty($data['shipping_country'])||empty($data['shipping_pincode'])||empty($data['shipping_mobile'])){
            return redirect()->back()->with('flash_message','Please full fill this field');

           }
           //Update user details
           User::where('id',$user_id)->update(['name'=>$data['billing_name'],'address'=>$data['billing_address'],'city'=>$data['billing_city'],'state'=>$data['billing_state'],'country'=>$data['billing_country'],'pincode'=>$data['billing_pincode'],'mobile'=>$data['billing_mobile']]);

           if($shippinCount>0){
            //update  shiping address
           DeliveryAddress::where('user_id',$user_id)->update(['name'=>$data['shipping_name'],'address'=>$data['shipping_address'],'city'=>$data['shipping_city'],'state'=>$data['shipping_state'],'country'=>$data['shipping_country'],'pincode'=>$data['shipping_pincode'],'mobile'=>$data['shipping_mobile']]);


           }else{

               //new shiping address

               $shipping = new DeliveryAddress;
               $shipping->user_id =$user_id;
               $shipping->user_email = $user_email;
               $shipping->name =$data['shipping_name'];
               $shipping->address =$data['shipping_address'];
               $shipping->city =$data['shipping_city'];
               $shipping->state =$data['shipping_state'];
               $shipping->country =$data['shipping_country'];
               $shipping->pincode =$data['shipping_pincode'];
               $shipping->mobile =$data['shipping_mobile'];
               $shipping->save();
           }
           return redirect()->action('productController@orderReview');
           
       }

        return view('products.checkout')->with(compact('userDetails','countries','shippingDetails'));
    }

    // order Review
    public function orderReview(Request $request){
        $user_id=Auth::user()->id;
        $user_email=Auth::user()->email;
        $userDetails=User::where('id',$user_id)->first();
        $shippingDetails=DeliveryAddress::where('user_id',$user_id)->first();
        $shippingDetails=json_decode(json_encode($shippingDetails));
         $userCart =DB::table('cart')->where(['user_email'=>$user_email])->get();
        foreach ($userCart as $key => $product_cart) {
            $productDetails =Product::where('id',$product_cart->product_id)->first();
            $userCart[$key]->image =$productDetails->image;
        }


        return view('products.order_review')->with(compact('shippingDetails','userDetails','userCart'));
    }


    public function applyCoupon(Request $request)

    {
        Session::forget('couponAmount');
        Session::forget('CouponCode');


        $data= $request->all();
        $couponCount =Coupon::where('coupons',$data['coupons'])->count();

        if($couponCount == 0){

            return redirect()->back()->with('flash_message','Coupon  code not valid');
        }else{
            //coupon details
            $couponDetails=Coupon::where('coupons',$data['coupons'])->first();

            if($couponDetails->status==0){
                return redirect()->back()->with('flash_message','Coupon code Inactive ');
            }

            $expiry_date=$couponDetails->expiry_date;
             $current_date=date('Y-m-d');

             if($expiry_date < $current_date){
                return redirect()->back()->with('flash_message','Coupon date expiry ');
             }

             $session_id=Session::get('session_id');
             $userCart =DB::table('cart')->where(['session_id'=>$session_id])->get();
            // $session_id=Session::get('session_id');
            if(Auth::check()){
                $user_email=Auth::user()->email;
                $userCart =DB::table('cart')->where(['user_email'=>$user_email])->get();
            }else{
                 $session_id=Session::get('session_id');
                 $userCart =DB::table('cart')->where(['session_id'=>$session_id])->get();
            }


        $total_amount=0;
        foreach ($userCart as  $items) {
            $total_amount =$total_amount+($items->price*$items->quantity);
            
        }

             //check coupon amount fix or percentage
             if($couponDetails->amount_type=="Fixed"){

                $couponAmount=$couponDetails->amount;
             }else{

                $couponAmount =$total_amount*($couponDetails->amount/100);
             }

             //add coupon code  and amount

             Session::put('couponAmount',$couponAmount);
             Session::put('CouponCode',$data['coupons']);
             return redirect()->back()->with('flash_message','add duscount');
        }
    }


//place order
    public function placeOrder(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            $user_id=Auth::user()->id;
            $user_email=Auth::user()->email;
            //shipping info
            $shippingDetails=DeliveryAddress::where(['user_email'=>$user_email])->first();
            //echo "<pre>";print_r($data);die;
            if(empty(Session::get('couponCode'))){
                $coupon_code='';
            }else{
                $coupon_code=Session::get('couponCode');
            }

            if(empty(Session::get('couponAmount'))){
                $coupon_amount=0;
            }else{

                $coupon_amount=Session::put('couponAmount');
            }
            $order =new Order;

            $order->user_id =$user_id;
            $order->user_email=$user_email;
            $order->name=$shippingDetails->name;
            $order->address=$shippingDetails->address;
            $order->city=$shippingDetails->city;
            $order->state=$shippingDetails->state;
            $order->country=$shippingDetails->country;
            $order->pincode=$shippingDetails->pincode;
            $order->mobile=$shippingDetails->mobile;
            $order->coupon_code=$coupon_code;
            $order->coupon_amount=$coupon_amount;
            $order->order_status="New";
            $order->payment_method=$data['payment_method'];
            $order->grand_total=$data['grand_total'];
            $order->save();
            //last insert ID
            $order_id=DB::getPdo()->lastInsertId();
            $cartProduct=DB::table('cart')->where(['user_email'=>$user_email])->get();

            foreach($cartProduct as $pro){

              $cartPro= new OrderProduct;
              $cartPro->order_id=$order_id;
               $cartPro->user_id=$user_id;
               $cartPro->product_id=$pro->product_id;
               $cartPro->product_code=$pro->product_code;
               $cartPro->product_name=$pro->product_name;
               $cartPro->product_color=$pro->product_color;
               $cartPro->product_size=$pro->size;
               $cartPro->product_qty=$pro->quantity;
               $cartPro->product_price=$pro->price;
               $cartPro->save();

            }
            Session::put('order_id',$order_id);
            Session::put('grand_total',$data['grand_total']);
        }
    }

    //thank page
    public function thanks(Request $request){
           $user_email=Auth::user()->email;
           DB::table('cart')->where(['user_email'=> $user_email])->delete();
      return view('orders.thanks');
    }
    //user order 

    public function  userOrders(Request $request){
       $user_id=Auth::user()->id;
       $orders=Order::with('orders')->where(['user_id'=>$user_id])->get();
       //$orders=json_decode(json_encode($orders));
       //echo "<pre>";print_r($orders);die;
      return view('orders.user_order')->with(compact('orders'));
    }

    public function userOrderDetails($id){
      $user_id=Auth::user()->id;
      $OrderDetails=Order::with('orders')->where('id',$id)->first();
      // $OrderDetails=json_decode(json_encode($OrderDetails));
      //  echo "<pre>";print_r($OrderDetails);die;

      return view('orders.user_order_details')->with(compact('OrderDetails'));
    }

    //paypal

    public function paypal(Request $request){
      return view('orders.paypal');

    }

}
