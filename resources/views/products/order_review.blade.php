@extends('frontlayout.front_design')

@section('content')

<section id="form"><!--form-->

			@if(Session::has('flash_message'))
		          
		          <div class="alert alert-error alert-block">
		            <button type="button" class="close" data-dismiss="alert">×</button> 
		                <strong>{{session('flash_message')}}</strong>
		        </div>
		        @endif
	
		<div class="container">
			
			<div class="row">
				
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>User Details</h2>
						
							<div class="form-group">
								{{$userDetails->name}}
							</div>
							<div class="form-group">
							{{$userDetails->address}}
						</div>
						<div class="form-group">
							{{$userDetails->city}}
						</div>
						<div class="form-group">
							{{$userDetails->state}}
						</div>
						<div class="form-group">
							{{$userDetails->country}}
							
						</div>
						<div class="form-group">
							{{$userDetails->pincode}}
						</div>
						<div class="form-group">
							<{{$userDetails->mobile}}
						</div>
						
							
							
						
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Ship to</h2>
						<div class="form-group">
							{{$shippingDetails->name}}
						</div>
						<div class="form-group">
							{{$shippingDetails->address}}
						</div>
						<div class="form-group">
							{{$shippingDetails->city}}
						</div>
						<div class="form-group">
							{{$shippingDetails->state}}
						</div>
						<div class="form-group">
							{{$shippingDetails->country}}
						</div>
						<div class="form-group">
							{{$shippingDetails->pincode}}
						</div>
						<div class="form-group">
							{{$shippingDetails->mobile}}
						</div>
							<!-- <button type="submit" class="btn btn-success">continue</button> -->
						
					</div><!--/sign up form-->
				</div>
			</div>
		
		</div>
	</section><!--/form-->
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="step-one">
				<h2 class="heading">Step1</h2>
			</div>
			<div class="checkout-options">
				<h3>New User</h3>
				<p>Checkout options</p>
				<ul class="nav">
					<li>
						<label><input type="checkbox"> Register Account</label>
					</li>
					<li>
						<label><input type="checkbox"> Guest Checkout</label>
					</li>
					<li>
						<a href=""><i class="fa fa-times"></i>Cancel</a>
					</li>
				</ul>
			</div><!--/checkout-options-->

			<div class="register-req">
				<p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
			</div><!--/register-req-->

			
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
                          <?php $total_amount =0;?>
						@foreach($userCart as $item)
						<tr>
							<td class="cart_product">
								<a href=""><img style="width: 60px;" src="{{asset('images/backend_image/products/small/'.$item->image)}}" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$item->product_name}}</a></h4>
								<p>Code: {{$item->product_code}} | {{$item->size}}</p>
							</td>
							<td class="cart_price">
								<p>${{$item->price}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href="{{url('/cart/update-quantity/'.$item->id.'/1')}}"> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="{{$item->quantity}}" autocomplete="off" size="2">
									@if($item->quantity>1)
									<a class="cart_quantity_down" href="{{url('/cart/update-quantity/'.$item->id.'/-1')}}"> - </a>
									@endif
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">${{$item->price*$item->quantity}}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{url('/cart/delete-product/'.$item->id)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
                      <?php $total_amount=$total_amount+($item->price*$item->quantity); ?>
                       @endforeach
						
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>{{ $total_amount}}</td>
									</tr>
									
									<tr class="shipping-cost">
										<td>Shipping Cost</td>
										<td>Free</td>										
									</tr>
									<tr class="shipping-cost">
										<td>Discount Amount</td>
										<td>
                                        @if(!empty(Session::get('couponAmount')))
										{{Session::get('couponAmount')}}
										@else
										0
										@endif
									</td>										
									</tr>
									<tr>
										<td> Grand Total</td>
										<td><span>${{ $grand_total=$total_amount-Session::get('couponAmount')}}</span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<form name="paymentForm" id="paymentForm" method="POST" action="{{url('/place-order')}}">

				{{csrf_field()}}
				<input type="hidden" name="grand_total" value="{{$grand_total}}">
				
			<div class="payment-options">
					<span>
						<label> <strong>Select Payment Method</strong></label>
					</span>
					<span>
						<label><input type="radio" name="payment_method" value="COD" id="COD"> COD</label>
					</span>
					<span>
						<label><input type="radio" name="payment_method" value="Paypal" id="Paypal"> Paypal</label>
					</span>
					<span style="float: right;">
						<button type="submit" class="btn btn-success" onclick="return selectPaymentMethod();">Place Order</button>
					</span>
				</div>
			</form>
		</div>
	</section> <!--/#cart_items-->

@endsection