
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
			</div>
			
		</div>
	</section><!--/#do_action-->

@endsection
<?php
Session::forget('grand_total');
Session::forget('order_id');

?>