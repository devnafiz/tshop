
@extends('frontlayout.front_design')

@section('content')

 @if(Session::has('flash_message'))
          
          <div class="alert alert-error alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{session('flash_message')}}</strong>
        </div>
        @endif
  
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<h3>Account Update</h3>
					<form  id="accountFrom" name="accountFrom" action="{{url('/account')}}" method="post">
							{{csrf_field()}}
							<input type="text" placeholder="Name" id="name" name="name"  class="form-control" value="{{$userDetails->name}}" />
							<input type="text" placeholder="address" id="address" name="address" class="form-control" value="{{$userDetails->address}}"/>
							<input type="text" placeholder="City" id="city" name="city" class="form-control" value="{{$userDetails->city}}"/>
							<input type="text" placeholder="State" id="state" name="state" class="form-control"  value="{{$userDetails->state}}"/>
							<select id="country" name="country">
								<option value="country">Select Country</option>
								@foreach($countries as $country)
								<option value="{{$country->country_name}}" @if($country->country_name ==$userDetails->country) selected @endif>{{$country->country_name}}</option>
								@endforeach
							</select>
							<input type="text" placeholder="Pincode" id="Pincode" name="pincode" class="form-control" value="{{$userDetails->pincode}}"/>
							<input type="text" placeholder="Mobile" id="mobile" name="mobile" class="form-control"  value="{{$userDetails->mobile}}"/>

							
							<button type="submit" class="btn btn-default">Update</button>
						</form>
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h3>Update Password</h3>
						<form id="passwordForm" name="passwordForm" method="POST" action="{{url('/update-user-pwd')}}">{{@csrf_field()}}
							<input type="password" name="current_pwd" id="current_pwd" placeholder="Current Password"  class="form-control">
							<span id="chkPwd"></span>
							<input type="password" name="new_pwd" id="new_pwd" placeholder="New Password" class="form-control">
							<input type="password" name="confirm_pwd" id="confirm_pwd" placeholder="Confirm Password" class="form-control">
							<button type="submit">Update</button>

						</form>
						
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	

@endsection