
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
					<div class="login-form"><!--login form-->
						<h2>Forgot Password ?</h2>
						<form action="{{url('/forgot-password')}}" id="forgotPasswordForm" name="forgotPasswordForm"  method="POST">
							{{csrf_field()}}
							<input type="email" name="email" placeholder="Email Address"  required="" />
							
							
							<button type="submit" class="btn btn-default">submit</button>
							
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form  id="registerForm" name="registerForm" action="{{url('/user-register')}}" method="post">
							{{csrf_field()}}
							<input type="text" placeholder="Name" id="name" name="name" />
							<input type="email" placeholder="Email Address" id="email" name="email" />
							<input type="password" placeholder="Password" id="password" name="password" />
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	

@endsection