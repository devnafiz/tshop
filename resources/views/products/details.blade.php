
@extends('frontlayout.front_design')

@section('content')
<section>
		<div class="container">
			<div class="row">

			 @if(Session::has('flash_message'))
		          
		          <div class="alert alert-error alert-block">
		            <button type="button" class="close" data-dismiss="alert">×</button> 
		                <strong>{{session('flash_message')}}</strong>
		        </div>
		        @endif
				<div class="col-sm-3">
					@include('frontlayout.front_sidebar')
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img class="mainImage" src="{{asset('images/backend_image/products/medium/'.$productDetails->image)}}" alt="" />
								<!-- <h3>ZOOM</h3> -->
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="item active">
											@foreach($altImages as $Images)
										  <img  class="changeImage" src="{{asset('images/backend_image/products/small/'.$Images->image)}}" alt="">
										  @endforeach
										  <!-- <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar3.jpg" alt=""></a> -->
										</div>
										<!-- <div class="item">
										  <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
										</div>
										<div class="item">
										  <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
										</div> -->
										
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">

							<form action="{{url('add-cart')}}" id="addtocartForm" name="addtocartForm" method="post">{{ csrf_field()}}
							<div class="product-information"><!--/product-information-->
								<input type="hidden" name="product_id" value="{{$productDetails->id}}">
								<input type="hidden" name="product_name" value="{{$productDetails->product_name}}">
								<input type="hidden" name="product_code" value="{{$productDetails->product_code}}">
								<input type="hidden" name="product_color" value="{{$productDetails->product_color}}">
								<input type="hidden" name="price" id="Price" value="{{$productDetails->price}}">
								

								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{$productDetails->product_name}}</h2>
								<p>code: {{$productDetails->product_code}}</p>
								<p>
									<select name="size" id="selSize" style="width: 150px;">
										<option value="">select</option>
										@foreach($productDetails->attributes as $sizes)
										  <option value="{{$productDetails->id}}-{{$sizes->size}}">{{$sizes->size}}</option>

										@endforeach

									</select>
								</p>
								<img src="images/product-details/rating.png" alt="" />
								<span>
									<span id="getPrice">US {{$productDetails->price}}</span>
									<label>Quantity:</label>
									<input type="text" name="quantity" value="3" />

									@if($total_stock>0)
									<button type="submit" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
									@endif
								</span>
								<p ><b>Availability:</b><span id="availablity"> @if($total_stock>0) In Stock @else Out of Stock @endif</p></span>
								<p><b>Condition:</b> New</p>
								<p><b>Brand:</b> E-SHOPPER</p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</form>
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="#details" data-toggle="tab">Description</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Material & care</a></li>
								<li><a href="#tag" data-toggle="tab">Delivery Option</a></li>
								<li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade" id="details" >
								<div class="col-md-12">
									<p>{{$productDetails->description}}</p>
									
								</div>
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								<div class="col-md-12">
									<p>{{$productDetails->care}}</p>
									
								</div>
							</div>
							
							<div class="tab-pane fade" id="tag" >
								<div class="col-md-12">
									<p>onsectetur adipisicing elit, sed do eiusmod</p>
									
								</div>
							</div>
							
							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									<p><b>Write Your Review</b></p>
									
									<form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
										<textarea name="" ></textarea>
										<b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
										<button type="button" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
                                 <?php $count=1;?>
								@foreach($relatedProduct->chunk(3) as  $chunk)
								<div <?php if($count==1) {?> class="item active" <?php } else { ?> class="item" <?php } ?> >	

									

									  @foreach($chunk as $item)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img style="width: 160px;" src="{{asset('images/backend_image/products/small/'.$item->image)}}" alt="" />
													<h2>${{$item->price}}</h2>
													<p>{{$item->product_name}}</p>
												<a href="{{url('/product/'.$item->id)}}">	<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button></a>
												</div>
											</div>
										</div>
									</div>
									 @endforeach
									
									
								</div>
								<?php $count++;?>
								@endforeach
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					
				</div>
			</div>
		</div>
	</section>
	@endsection