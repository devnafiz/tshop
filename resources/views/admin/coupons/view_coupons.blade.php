@extends('adminlayout.admin_design')

@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Coupons</a> </div>
    <h1>view coupon</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
      	 @if(Session::has('flash_message'))
          
          <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{session('flash_message')}}</strong>
        </div>
        @endif
        @if(Session::has('flash_message_success'))
          
          <div class="alert alert-error alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{session('flash_message_success')}}</strong>
        </div>
        @endif
        
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Coupon table</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Coupons ID</th>
                  <th>Coupons </th>
                  <th>Coupons type</th>
                  <th>Coupons Amount</th>
                  <th> Expirydate</th>
                  <th>Status</th>
                  
                  
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($coupons as $coupon)
                <tr class="gradeX">
                  <td>{{$coupon->id}}</td>
                  <td>{{$coupon->coupons}}</td>
                  <td>{{$coupon->amount_type}}</td>
                  <td>{{$coupon->amount}}
                    @if ($coupon->amount_type=="Percentage") % @else $ @endif
                  </td>
                  <td>{{$coupon->date}}</td>
                  <td>
                   @if($coupon->status==1) Active @else Inactive @endif
                  </td>
                  
                  
                  <td>
                  
                  </td>
                  <td class="center"><a href="{{url('/admin/edit-coupon/'.$coupon->id)}}" class="btn btn-primary btn-mini">Edit</a> 
                     
                    <a href="#myModal{{$coupon->id}}" data-toggle="modal" class="btn btn-success btn-mini">View</a> <a rel="{{$coupon->id}}"  rel1="delete-coupon" <?php /* href="{{url('/admin/delete-product/'.$product->id)}}" */?> href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a></td>
                </tr>

                
                @endforeach
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



@endsection