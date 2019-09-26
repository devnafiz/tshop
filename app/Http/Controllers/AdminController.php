<?php

namespace App\Http\Controllers;
use Auth;
use Session;
use App\User;
use App\Admin;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login(Request $request)
    {
    	if($request->isMethod('post')){
    		$data=$request->input();
        $adminCount=Admin::where(['username'=>$data['username'],'password'=>md5($data['password']),'status'=>1])->count();
        if($adminCount>0){
    		Session::put('adminSession',$data['username']);
    			return redirect('/admin/dashboard');
    		}else{
    			//echo "failed" ;die;
    			return redirect('/admin')->with('flash_message','Invalid Username or Password');
    		}
    	}
         return view('admin.admin_login');
    	}

    public function dashboard()
    {
    	//if(Session::has('adminSession')){

    	//}else{
           // return redirect('/admin')->with('flash_message','Invalid Username or Password');

    	//}
    	 return view('admin.dashboard');
    	
    	
    	
    }

    public function settings(){
      $adminDeatils=Admin::where(['username'=>Session::get('adminSession')])->first();
    	return view('admin.settings')->with(compact('adminDeatils'));
    }
    public function chkPassword(Request $request){
       $data=$request->all();
       //$current_password =$data['current_pwd'];
       //$check_password = Admin::where(['username'=>Session::get('adminSession')])->first();
       $adminCount=Admin::where(['username'=>Session::get('adminSession'),'password'=>md5($data['current_pwd'])])->count();
       if($adminCount == 1){
       	echo "true";die;
       }else{
       	echo "false";die;
       }

    }
    public function updatePassword(Request $request){
    	if($request->isMethod('post')){
    		$data=$request->all();
    		//echo "<pre>";print_r($data);die;
    		//$check_password =User::where(['email'=>Auth::user()->email])->first();
    		//$current_password =$data['current_pwd'];
        $adminCount=Admin::where(['username'=>Session::get('adminSession'),'password'=>md5($data['current_pwd'])])->count();
    		if($adminCount==1){
       	   $password =md5($data['new_pwd']);
       	   Admin::where('username',Session::get('adminSession'))->update(['password'=>$password]);
       	   return redirect('/admin/settings')->with('flash_message','Password Update');

       }else{
       	echo "false";die;
       }

    	}
    }

    public function logout(){
    	Session::flush();
    	return redirect('/admin')->with('flash_message_success','Successfully logout');
    }
// admin sub admin
    public function viewAdmin(){

           $admins=Admin::get();
           // $admins=json_decode(json_encode($admins));
           // echo "<pre>";print_r($admins);die;
           return view('admin.admins.view_admin')->with(compact('admins'));


    }
    //add admin /sub admin
    public function addAdmin(Request $request){

      if($request->isMethod('post')){
        $data=$request->all();
        $adminCount=Admin::where('username',$data['username'])->count();
        if ($adminCount>0) {
          return redirect()->back()->with('flash_message','Admin Username already Exist!');
        }else{
           if(empty($data['status'])){
              $data['status']=0;
            }

          if($data['type']=="Admin"){
          $admin=new Admin;
          $admin->type=$data['type'];
          $admin->username=$data['username'];
          $admin->password=md5($data['password']);
          $admin->status=$data['status'];
          $admin->save();
          return redirect()->back()->with('flash_message','Username add Successfully');
          }else if($data['type']=="Sub Admin"){
            if(empty($data['categories_access'])){
              $data['categories_access']=0;
            }
            // if(empty($data['categories_view_access'])){
            //   $data['categories_view_access']=0;
            // }
            // if(empty($data['categories_edit_access'])){
            //   $data['categories_edit_access']=0;
            // }
            // if(empty($data['categories_full_access'])){
            //   $data['categories_full_access']=0;
            // }
            if(empty($data['products_access'])){
              $data['products_access']=0;
            }
            if(empty($data['orders_access'])){
              $data['orders_access']=0;
            }
            if(empty($data['users_access'])){
              $data['users_access']=0;
            }
            



             $admin=new Admin;
          $admin->type=$data['type'];
          $admin->username=$data['username'];
          $admin->password=md5($data['password']);
          $admin->status=$data['status'];
          $admin->categories_access=$data['categories_access'];
          // $admin->categories_view_access=$data['categories_view_access'];
          // $admin->categories_edit_access=$data['categories_edit_access'];
          // $admin->categories_full_access=$data['categories_full_access'];
          $admin->products_access=$data['products_access'];
          $admin->orders_access=$data['orders_access'];
          $admin->users_access=$data['users_access'];
          $admin->save();
          return redirect()->back()->with('flash_message','Username add Successfully');
          }
         
        }
      }
      return view('admin.admins.add_admin');
    }

    public function editAdmin(Request $request,$id){
      if($request->isMethod('post')){
        $data=$request->all();

         if(empty($data['status'])){
              $data['status']=0;
            }

          if($data['type']=="Admin"){
          Admin::where('username',$data['username'])->update(['password'=>md5($data['password']),'status'=>$data['status']]);
          return redirect()->back()->with('flash_message','Username update Successfully');
          }else if($data['type']=="Sub Admin"){
            if(empty($data['categories_access'])){
              $data['categories_access']=0;
            }
            if(empty($data['products_access'])){
              $data['products_access']=0;
            }
            if(empty($data['orders_access'])){
              $data['orders_access']=0;
            }
            if(empty($data['users_access'])){
              $data['users_access']=0;
            }
            



           Admin::where('username',$data['username'])->update(['password'=>md5($data['password']),'status'=>$data['status'],'categories_access'=>$data['categories_access'],'products_access'=>$data['products_access'],'orders_access'=>$data['orders_access'],'users_access'=>$data['users_access']]);
          return redirect()->back()->with('flash_message','Username update Successfully');
          }
      }

      $adminDetails=Admin::where('id',$id)->first();

      return view('admin.admins.edit_admin')->with(compact('adminDetails'));
    }


}

