<?php

namespace App\Http\Controllers;
use App\Page;

use Illuminate\Http\Request;

class PageController extends Controller
{
     public function addPage(Request $request){
     	if($request->isMethod('post')){

     		$data= $request->all();

     		$page = new Page;
     		$page->title =$data['title'];
     		$page->description=$data['description'];
     		$page->url=$data['url'];
     		if(empty($data['status'])){

     			$status='0';
     		}else{
     			$status ='1';
     		}
     		$page->status=$status;
     		$page->save();
     		//echo "<pre>";print_r($data);die;
     		return redirect()->back()->with('flash_message','Successfully add page');
     	}

     	return view('admin.page.add-page');
     }

     public function viewPage(Request $request){
     	$pages =Page::get();
     	return view('admin.page.view-page')->with(compact('pages'));
     }
}
