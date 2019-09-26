@extends('adminlayout.admin_design')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Admin</a> <a href="#" class="current">Edit Admin</a> </div>
    <h1>Edit Admin</h1>
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
            <h5>Edit Admin</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/edit-admin/'.$adminDetails->id)}}" name="edit_admin" id="edit_admin" novalidate="novalidate" enctype="multipart/form-data">
            	{{ csrf_field()}}

              <div class="control-group">
                <label class="control-label">Type</label>
                <div class="controls">
                 
                 <input type="text" name="type" id="title"  readonly="" value="{{$adminDetails->type}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">User name</label>
                <div class="controls">
                  <input type="text" name="username" id="username"  required="" value="{{$adminDetails->username}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Password</label>
                <div class="controls">
                  <input type="password" name="password" id="password"  required="">
                </div>
              </div>
              
              
               @if($adminDetails->type=="Sub Admin")
              
               <div id="">
              <div class="control-group">
                <label class="control-label">Category access </label>
                <div class="controls">
                  <input type="checkbox" name="categories_access" id="categories_access"@if($adminDetails->categories_access=="1")checked @endif value="1">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Product Access </label>
                <div class="controls">
                  <input type="checkbox" name="products_access" id="products_access" @if($adminDetails->products_access=="1")checked @endif value="1">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Order Access </label>
                <div class="controls">
                  <input type="checkbox" name="orders_access" id="orders_access" @if($adminDetails->orders_access=="1")checked @endif value="1">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">User Access </label>
                <div class="controls">
                  <input type="checkbox" name="users_access" id="users_access" @if($adminDetails->users_access=="1")checked @endif value="1">
                </div>
              </div>
            </div>
            @endif
              <div class="control-group">
                <label class="control-label">Enable </label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" @if($adminDetails->status=="1")checked @endif value="1">
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Edit Admin" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>

@endsection
