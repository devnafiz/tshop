@extends('adminlayout.admin_design')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Bnner</a> <a href="#" class="current">add Admin</a> </div>
    <h1>Add Admin</h1>
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
            <h5>Add Admin</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/add-admin')}}" name="add_admin" id="add_admin" novalidate="novalidate" enctype="multipart/form-data">
            	{{ csrf_field()}}

              <div class="control-group">
                <label class="control-label">Type</label>
                <div class="controls">
                 <select name="type" id="type" style="width: 220px">
                   <option value="Admin">Admin</option>
                    <option value="Sub Admin">Sub Admin</option>

                 </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">User name</label>
                <div class="controls">
                  <input type="text" name="username" id="title"  required="">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Password</label>
                <div class="controls">
                  <input type="password" name="password" id="password"  required="">
                </div>
              </div>
              
              
             
              
               <div id="Access">
              <div class="control-group">
                <label class="control-label">Category access </label>
                <div class="controls">
                  <input type="checkbox" name="categories_access" id="categories_access" value="1">
                </div>
              </div>
              
              <div class="control-group">
                <label class="control-label">Product Access </label>
                <div class="controls">
                  <input type="checkbox" name="products_access" id="products_access" value="1">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Order Access </label>
                <div class="controls">
                  <input type="checkbox" name="orders_access" id="orders_access" value="1">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">User Access </label>
                <div class="controls">
                  <input type="checkbox" name="users_access" id="users_access" value="1">
                </div>
              </div>
            </div>
              <div class="control-group">
                <label class="control-label">Enable </label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1">
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Add Admin" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>

@endsection
