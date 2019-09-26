<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Banners;
use Session;
use Image;

class BannerController extends Controller
{
    public function addBanner(Request $request)
    {

    	if($request->isMethod('post')){

    		$data=$request->all();

    		//echo "<pre>"; print_r($data);die;

    		$banners = new Banners;

    		$banners->title =$data['title'];
    		$banners->link =$data['link'];
    		
    		if($request->hasFile('image')){
    			$image_tmp =Input::file('image');
    			if($image_tmp->isValid()){
    				$extension =$image_tmp->getClientOriginalExtension();
    				$filename = rand(111,99999).'.'.$extension;
    				$large_image_path ='images/frontend_image/banner/'.$filename;
                    //intervention image pavkeage
    				
    				Image::make($image_tmp)->resize(1140,340)->save($large_image_path);
    				
    				//store image
    				$banners->image =$filename;

    			}

    		}
    		if(empty($data['status'])){
                $status=0;

            }else{
                $status=1;
            }
    		$banners->status=$status;
    		$banners->save();
    		return redirect()->back()->with('flash_message','Banner upload successfully');
          }
    	 return view('admin.banners.add_banner');
    	
    }

    public function viewBanner(Request $request)
    {
    	$banners=Banners::get();

    	return view('admin.banners.view_banner')->with(compact('banners'));
    }

    public function editBanner(Request $request,$id=null)
    {

    	if($request->isMethod('post')){

    		$data=$request->all();
    		if(empty($data['status'])){

    			$status='0';
    		}else{
                 $status='1';
    		}

    		if(empty($data['title'])){
    			$data['title']='';
    		}
    		if(empty($data['link'])){
    			$data['link']='';
    		}

    		if($request->hasFile('image')){
    			$image_tmp =Input::file('image');
    			if($image_tmp->isValid()){
    				$extension =$image_tmp->getClientOriginalExtension();
    				$filename = rand(111,99999).'.'.$extension;
    				$large_image_path ='images/frontend_image/banner/'.$filename;
    				
    				Image::make($image_tmp)->resize(1130,340)->save($large_image_path);
    				
    				//store image
    				//$product->image =$filename;

    			}

    		}else if(!empty($data['current_image'])){
                 $filename =$data['current_image'];
    		}else{
    			$filename = '';
    		}
    		Banners::where(['id'=>$id])->update(['title'=>$data['title'],'link'=>$data['link'],'image'=>$filename,'status'=>$status]);
    		return redirect()->back()->with('flash_message','Banners update successfully!');
    	}
        $bannerDetails=Banners::where('id',$id)->first();
        return view('admin.banners.edit_banner')->with(compact('bannerDetails'));
    }

    public function deleteBanner(Request $request,$id=null)
    {
    	Banners::where(['id'=>$id])->delete();

    	return redirect()->back()->with('flash_message','Banners Delete successfully!');
    }
}
