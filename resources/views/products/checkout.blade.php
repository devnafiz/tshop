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
			<form action="{{url('/checkout')}}" method="POST" id="CheckoutForm">
				{{csrf_field()}}
			<div class="row">
				
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>bill to</h2>
						<form action="#">
							<div class="form-group">
								<input type="text" name="billing_name" id="billing_name" @if(!empty($userDetails->name)) value="{{$userDetails->name}}" @endif placeholder="Name"  class="form-control"/>
							</div>
							<div class="form-group">
							<input type="text" name="billing_address" id="billing_address" placeholder=" Address" class="form-control" @if(!empty($userDetails->address)) value="{{$userDetails->address}}" @endif />
						</div>
						<div class="form-group">
							<input type="text" name="billing_city"  id="billing_city" placeholder=" City" class="form-control" @if(!empty($userDetails->city)) value="{{$userDetails->city}}"  @endif />
						</div>
						<div class="form-group">
							<input type="text" name="billing_state" id="billing_state" placeholder=" State" class="form-control" @if(!empty($userDetails->state)) value="{{$userDetails->state}}" @endif />
						</div>
						<div class="form-group">
							<select id="billing_country" name="billing_country">
								<option value="country">Select Country</option>
								@foreach($countries as $country)
								<option value="{{$country->country_name}}" @if($country->country_name ==$userDetails->country) selected @endif>{{$country->country_name}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<input type="text" name="billing_pincode" id="billing_pincode" placeholder=" Pincode"  class="form-control" @if(!empty($userDetails->pincode)) value="{{$userDetails->pincode}}" @endif />
						</div>
						<div class="form-group">
							<input type="text" name="billing_mobile" id="billing_mobile" placeholder=" Mobile" class="form-control" @if(!empty($userDetails->mobile)) value="{{$userDetails->mobile}}" @endif />
						</div>
						<div class="form-check" > 
							<input type="checkbox" name="" class="form-check-input" id="CopyAddress" >
							<label class="form-check-label" for="CopyAddress"> bill to ship</label>
						</div>
							
							
						
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Ship to</h2>
						<div class="form-group">
							<input type="text" name="shipping_name" id="shipping_name" placeholder="Name"  class="form-control" @if(!empty($shippingDetails->name)) value="{{$shippingDetails->name}}"  @endif/>
						</div>
						<div class="form-group">
							<input type="text" name="shipping_address" id="shipping_address" placeholder=" Address" class="form-control" @if(!empty($shippingDetails->address)) value="{{$shippingDetails->address}}"  @endif/>
						</div>
						<div class="form-group">
							<input type="text" name="shipping_city" id="shipping_city" placeholder=" City" class="form-control" @if(!empty($shippingDetails->city)) value="{{$shippingDetails->city}}"  @endif/>
						</div>
						<div class="form-group">
							<input type="text" name="shipping_state" id="shipping_state" placeholder=" State"  class="form-control" @if(!empty($shippingDetails->state)) value="{{$shippingDetails->state}}" @endif />
						</div>
						<div class="form-group">
							<input type="text"  name="shipping_country" id="shipping_country"  placeholder=" Country" class="form-control" @if(!empty($shippingDetails->country)) value="{{$shippingDetails->country}}" @endif />
						</div>
						<div class="form-group">
							<input type="text" name="shipping_pincode" id="shipping_pincode"  placeholder=" Pincode" class="form-control" @if(!empty($shippingDetails->pincode)) value="{{$shippingDetails->pincode}}" @endif/>
						</div>
						<div class="form-group">
							<input type="text" name="shipping_mobile" id="shipping_mobile"  placeholder=" Mobile"  class="form-control" @if(!empty($shippingDetails->mobile)) value="{{$shippingDetails->mobile}}" @endif />
						</div>
							<button type="submit" class="btn btn-success">continue</button>
						
					</div><!--/sign up form-->
				</div>
			</div>
		</form>
		</div>
	</section><!--/form-->

@endsection