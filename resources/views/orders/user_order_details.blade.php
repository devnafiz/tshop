
@extends('frontlayout.front_design')

@section('content')


  	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Orders</li>
				</ol>
			</div>

			
			
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading" align="center">
				  <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>User Order Details</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Product code</th>
                  <th>Product name</th>
                  <th>Product size</th>
                  <th>Product color</th>
                  <th>Product price</th>
                  <th>Product qty</th>
                  
                  
                </tr>
              </thead>
              <tbody>
              	@foreach($OrderDetails->orders as $pro)
                <tr class="gradeX">
                  <td>{{$pro->product_code}}</td>
                  <td>{{$pro->product_name}}</td>
                  <td>{{$pro->product_size}}</td>
                  <td>{{$pro->product_color}}</td>
                   <td>{{$pro->product_price}}</td>
                   <td>{{$pro->product_qty}}</td>
                 
                </tr>
                @endforeach
                
              </tbody>
            </table>
          </div>
        </div>

				
			</div>
			
		</div>
	</section><!--/#do_action-->

@endsection
