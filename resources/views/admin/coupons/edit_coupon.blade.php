@extends('adminlayout.admin_design')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Coupon</a> <a href="#" class="current">add coupon</a> </div>
    <h1>Form validation</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
         @if(Session::has('flash_message'))
          
          <div class="alert alert-error alert-block">
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
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit coupon</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/edit-coupon/'.$couponDetails->id)}}" name="edit_coupon" id="edit_coupon"  >
              {{ csrf_field()}}
              <div class="control-group">
                <label class="control-label">Coupon Code</label>
                <div class="controls">
                  <input type="text" name="coupons" id="coupons" value="{{$couponDetails->coupons}}" minlength="5" maxlength="15" required>
                </div>
              </div>
              
              <div class="control-group">
                <label class="control-label">Amount</label>
                <div class="controls">
                  <input type="number" name="amount" id="amount" value="{{$couponDetails->amount}}" required min="0">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Amount Type</label>
                <div class="controls">
                  <select name="amount_type" style="width: 220px">
                    <option value="Percentage" @if($couponDetails->amount_type=="Percentage") selected @endif value="Percentage" >Percentage</option>
                    <option value="Fixed" @if($couponDetails->amount_type=="Fixed") selected @endif value="Fixed">Fixed</option>
                    
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Expiry date</label>
                <div class="controls">
                  <input type="text" name="expiry_date"  data-date="2019-01-02" data-date-format="yyyy-mm-dd" value="{{$couponDetails->expiry_date}}" class="datepicker" required>
                   
                </div>
              </div>
              
              <div class="control-group">
                <label class="control-label">Status </label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1" @if($couponDetails->status=="1") checked @endif >
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Add coupon" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>

@endsection
