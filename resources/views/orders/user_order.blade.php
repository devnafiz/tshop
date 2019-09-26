
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
            <h5>Data table</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Odered  Product</th>
                  <th>Payment Method</th>
                  <th>Grand Total</th>
                  <th>Created on</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($orders as $order)
                <tr class="gradeX">
                  <td>{{$order->id}}</td>
                  <td>@foreach($order->orders as $pro)
                  	<a href="{{url('/orders/'.$order->id)}}"> {{$pro->product_code}}</a><br/>

                    @endforeach
                  </td>
                  <td>{{$order->payment_method}}</td>
                  <td>{{$order->grand_total}}</td>
                   <td>{{$order->created_at}}</td>
                  <td class="center"> <a rel="{{$order->id}}"  rel1="delete-product" <?php /* href="{{url('/admin/delete-product/'.$product->id)}}" */?> href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a></td>
                </tr>
                @endforeach
                <tr class="gradeU">
                  <td>Other browsers</td>
                  <td>All others</td>
                  <td>-</td>
                  <td class="center">-</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

				
			</div>
			
		</div>
	</section><!--/#do_action-->

@endsection
