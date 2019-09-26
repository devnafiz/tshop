<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\Country;
use DB;
use Illuminate\Support\Facades\Hash;
use Mail;

class UsersController extends Controller
{

	public function userLoginRegister(){
		return view('users.register_login');
	}
    public function register(Request $request)
    {
    	if($request->isMethod('post')){

    		$data=$request->all();
    		//echo "<pre>";print_r($data);die;
    		$userCount =User::where('email',$data['email'])->count();
    		if($userCount>0){

    			return redirect()->back()->with('flash_message','Your Email Already Exist');
    		}
    		$users = new User;
    		$users->name =$data['name'];
    		$users->email =$data['email'];
    		$users->password =bcrypt($data['password']);
    		$users->save();
    		if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
    			Session::put('frontSession',$data['email']);

                //update cart email when login
                if(!empty(Session::get('session_id'))){
                    $session_id=Session::get('session_id');
                   DB::table('cart')->where('session_id',$session_id)->update(['user_email'=>$data['email']]);
                }
             return redirect('/cart')->with('flash_message','Successfully  signup');
    		}

        }
    	 //return view('users.register_login');
    	
    }

    //account
    public function account(Request $request){
    	    $user_id =Auth::user()->id;
    	    $userDetails=User::find($user_id);
            $countries=Country::get();
             if($request->isMethod('post')){

             	$data =$request->all();
             	if(empty($data['name'])){

             		return redirect()->back()->with('flash_message','Enter your Name for Update Acount');
             	}
             	if(empty($data['address'])){

             		$data['address']='';
             	}
             	if(empty($data['city'])){

             		$data['city']='';
             	}
             	if(empty($data['state'])){

             		$data['state']='';
             	}
             	if(empty($data['country'])){

             		$data['country']='';
             	}
             	if(empty($data['pincode'])){

             		$data['pincode']='';
             	}
             	if(empty($data['mobile'])){

             		$data['mobile']='';
             	}
             	


             	$user= User::find($user_id);
             	$user->name=$data['name'];
             	$user->address=$data['address'];
             	$user->city=$data['city'];
             	$user->state=$data['state'];
             	$user->country=$data['country'];
             	$user->pincode=$data['pincode'];
             	$user->mobile=$data['mobile'];
             	$user->save();
             	return redirect()->back();
             	
             }

   return view('users.account')->with(compact('countries','userDetails'));


    }
    //update password
    public function updatePassword(Request $request){

    	if($request->isMethod('post')){
    		$data=$request->all();

    		$old_pwd =User::where('id',Auth::User()->id)->first();
    		$current_pwd=$data['current_pwd'];
    		if(Hash::check($current_pwd,$old_pwd->password)){
               $new_pwd =bcrypt($data['new_pwd']);
               User::where('id',Auth::User()->id)->update(['password'=>$new_pwd]);
               return redirect()->back()->with('flash_message','Update password');

    		}else{
    			return redirect()->back()->with('flash_message','Password may be wrong');
    		}
    	}
    }

    //check user current Password

public function chkUserPassword(Request $request){

	$data = $request->all();
	// echo "<pre>";print_r($data);die;

	$current_password = $data['current_pwd'];
	$user_id = Auth::User()->id;
	$check_password = User::where('id',$user_id)->first();
	if(Hash::check($current_password,$check_password->password)){
		echo "true";die;
	}else{
		echo "false";die;
	}

}
    //user login

    public function login(Request $request){
     if($request->isMethod('post')){

     	$data=$request->all();
     	// echo "<pre>";print_r($data);die;
     	if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){

     		Session::put('frontSession',$data['email']);
             if(!empty(Session::get('session_id'))){
                    $session_id=Session::get('session_id');
                   DB::table('cart')->where('session_id',$session_id)->update(['user_email'=>$data['email']]);
                }
     		return redirect('/cart');
     	}else{
     		return redirect()->back()->with('flash_message','email or password not valid');
     	}
     }
    }

    public function logout(){

    	Auth::logout();
    	// session   miche felar joono forget use kora hoise
    	Session::forget('frontSession');
    	return redirect('/');
    }

    public function checkEmail(Request $request)
    {
    	$data=$request->all();
    	$userCount =User::where('email',$data['email'])->count();
    		if($userCount>0){

    			echo "false";
    		}else{
    			echo "true";die;
    		}

    }

    public function forgotPassword(Request $request){
        if($request->isMethod('post')){

            $data=$request->all();
            $userCount=User::where('email',$data['email'])->count();
            if($userCount==0){
                return redirect()->back()->with('flash_message','Email does not Exist!');
            }
             $userDetails=User::where('email',$data['email'])->first();
            //Generate random Password
             $random_password=str_random(8);
             //encode /secure password
             $new_password=bcrypt($random_password);
             //update Password
             User::where('email',$data['email'])->update(['password'=>$new_password]);
             //send forget Password through email
             $email=$data['email'];
             $name=$userDetails->name;

             $messageData=['email'=>$email,
                             'name'=>$name,
                            'password'=>$random_password
            ];

            Mail::send('emails.forgotpassword',$messageData,function($message)use($email){
                $message->to($email)->subject('New Password');

            });
            return redirect('register_login')->with('flash_message','Check Your new Password');

        }

        return view('users.forgot_password');
    }
}
