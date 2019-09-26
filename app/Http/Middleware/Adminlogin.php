<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Route;

use Closure;
use Session;
use App\Admin;

class Adminlogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //echo Session::get('frontSession'); die;
        if(empty(Session::has('adminSession'))){
            return redirect('/admin');
        }else{
            //get admin/sub admin details
            $adminDetails=Admin::where('username',Session::get('adminSession'))->first();
            $adminDetails=json_decode(json_encode($adminDetails),true);
            //Session::put('adminDetails',$adminDetails);
            if($adminDetails['type']=="Admin"){
                      $adminDetails['categories_access']=1;
                      $adminDetails['products_access']=1;
                      $adminDetails['orders_access']=1;
                      $adminDetails['users_access']=1;

                //Session::get('adminDetails');
            }
               Session::put('adminDetails',$adminDetails);
              $currentPath= Route::getFacadeRoot()->current()->uri();
              if($currentPath=="admin/view-category" && Session::get('adminDetails')['categories_access']==0){
                return redirect('admin/dashboard')->with('flash_message','You have not access this menu');

              }
              if($currentPath=="admin/view-product" && Session::get('adminDetails')['products_access']==0){
                return redirect('admin/dashboard')->with('flash_message','You have not access this menu');

              }
              if($currentPath=="admin/view-admin" && Session::get('adminDetails')['users_access']==0){
                return redirect('admin/dashboard')->with('flash_message','You have not access this menu');

              }


            //echo "<pre>";print_r(Session::get('adminDetails'));die;
        }
        return $next($request);
    }
}
