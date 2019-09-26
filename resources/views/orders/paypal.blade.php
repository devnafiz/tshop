
@extends('frontlayout.front_design')

@section('content')


  	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Thanks</li>
				</ol>
			</div>

			
			
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading" align="center">
				<h3>YOUR ORDER HAS BEEN PLACE</h3>
				<p>YOUR ORDER NUMBER {{Session::get('order_id')}} AND PAYABLE {{Session::get('grand_total')}}----</p>
				<p>If you want to pay MANY  BELOW BUTTON</p>
			</div>
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="221">
				

			</form>
			
		</div>
	</section><!--/#do_action-->

@endsection
<?php
Session::forget('grand_total');
Session::forget('order_id');

?>