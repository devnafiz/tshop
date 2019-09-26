<?php

namespace App\Http\Controllers;
use App\Product;
use App\Category;
use App\Banners;

use Illuminate\Http\Request;

class IndexController extends Controller
{
   public function index()
   {
   	$productAll=Product::orderBy('id','DESC')->get();
   	$productAll=Product::inRandomOrder()->where('status',1)->get();
   	// ulotpalot
   	//category 
   	$categories=Category::with('categories')->where(['parent_id'=>0])->get();
   	//$categories=json_decode(json_encode($categories));
   	//$categroy_manu="";
   	// foreach ($categories as  $cat) {
   		
   	// 	 $categroy_manu.="    <div class='panel panel-default'>
				// 				<div class='panel-heading'>
				// 					<h4 class='panel-title'>
				// 						<a data-toggle='collapse' data-parent='#accordian' href='#".$cat->id."'>
				// 							<span class='badge pull-right'><i class='fa fa-plus'></i></span>
				// 							".$cat->name."
				// 						</a>
				// 					</h4>
				// 				</div>
    //                              <div id='".$cat->id."' class='panel-collapse collapse'>
				// 					<div class='panel-body'>
				// 						<ul>";
				// 						$sub_categories= Category::where(['parent_id'=>$cat->id])->get();
				// 				   		foreach ($sub_categories as  $sub_cat) {

				// 				   			$categroy_manu.="<li><a href='".$sub_cat->url."''>".$sub_cat->name." </a></li>";
								   			
				// 				   		}

											
											
				// 						$categroy_manu.= "</ul>
				// 					</div>
				// 				</div>";
								
   	// 	// $sub_categories= Category::where(['parent_id'=>$cat->id])->get();
   	// 	// foreach ($sub_categories as  $sub_cat) {
   	// 	// 	echo $sub_cat->name;
   	// 	// }
   	// }

   	$banners=Banners::where('status','1')->get();
   	 return view('index')->with(compact('productAll','categories','banners'));
   }
}
