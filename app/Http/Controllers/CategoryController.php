<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function addCategory(Request $request){
        if($currentPath=="admin/view-category" && Session::get('adminDetails')['categories_access']==0){
                return redirect('admin/dashboard')->with('flash_message','You have not access this menu');

              }
    	if($request->isMethod('post')){
    	$data=$request->all();
    	 //echo "<pre>";print_r($data);die;
        if(empty($data['status'])){
            $status=0;
        }else{
            $status=1;
        }
    	$category = new Category;
    	$category->name =$data['name'];
    	$category->parent_id=$data['parent_id'];
    	$category->description =$data['description'];
    	$category->url =$data['url'];
        $category->status=$status;
    	$category->save();
    	return redirect('/admin/view-category')->with('flash_message','Successfully add category');

    	}
    	$levels =Category::where(['parent_id'=>0])->get();
    	return view('admin.categories.add-category')->with(compact('levels'));
    }
    public function editCategory(Request $request, $id = null){
    	if($request->isMethod('post')){
    		$data= $request->all();
    		//echo "<pre>"; print_r($data);die;
            if(empty($data['status'])){
            $status=0;
        }else{
            $status=1;
        }

    		Category::where(['id'=>$id])->update(['name'=>$data['name'],'description'=>$data['description'],'url'=>$data['url'],'status'=>$status]);
    		return redirect('/admin/view-category')->with('flash_message','Successfully edit');
    	}
    	$categoryDetails = Category::where(['id'=>$id])->first();
    	$levels =Category::where(['parent_id'=>0])->get();
    	return view('admin.categories.edit_category')->with(compact('categoryDetails','levels'));
    }
    public function deleteCategory($id = null){
    	if(!empty($id)){
    		Category::where(['id'=>$id])->delete();
    		return redirect()->back()->with('flash_message','Successfully delete Category');
    	}
    }

    public function viewCategory(){
        if($currentPath=="admin/view-category" && Session::get('adminDetails')['categories_access']==0){
                return redirect('admin/dashboard')->with('flash_message','You have not access this menu');

              }
    	$categories=Category::get();
    	return view('admin.categories.view-category')->with(compact('categories'));
    }
}
