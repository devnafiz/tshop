@extends('adminlayout.admin_design')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">product</a> <a href="#" class="current">edit product</a> </div>
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
            <h5>edit product</h5>
          </div>
          <div class="widget-content nopediting">
            <form class="form-horizontal" method="post" action="{{url('/admin/edit-product/'.$productDetails->id)}}" name="edit_product" id="edit_product" novalidate="novalidate" enctype="multipart/form-data">
            	{{ csrf_field()}}
              <div class="control-group">
                <label class="control-label">product Name</label>
                <div class="controls">
                  <input type="text" name="product_name" id="product_name" value="{{$productDetails->product_name}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">product Level</label>
                <div class="controls">
                  <select name="category_id" style="width: 220px">
                  	<?php echo $category_dropdown;?>
                  	
                  	
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">product Code</label>
                <div class="controls">
                  <input type="text" name="product_code" id="product_code" value="{{$productDetails->product_code}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">product Color</label>
                <div class="controls">
                  <input type="text" name="product_color" id="product_color" value="{{$productDetails->product_color}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                  <input type="text" name="description" id="description" value="{{$productDetails->description}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Material & care</label>
                <div class="controls">
                  <input type="text" name="care" id="care" value="{{$productDetails->care}}">
                </div>
              </div>
              
              <div class="control-group">
                <label class="control-label">product price</label>
                <div class="controls">
                  <input type="text" name="price" id="price" value="{{$productDetails->price}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Image</label>
                <div class="controls">
                  <input type="file" name="image" id="image">
                  <input type="hidden" name="current_image" value="{{$productDetails->image}}">
                  @if(!empty($productDetails->image))
                  <img src="{{asset('/images/backend_image/products/small/'.$productDetails->image)}}" style="width: 40px;">|<a href="{{url('/admin/delete-product-image/'.$productDetails->id)}}">Delete</a>
                  @endif
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Enable </label>
                <div class="controls">
                  <input type="checkbox" name="status" id="url" @if($productDetails->status=="1") checked @endif value="1">
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="edit product" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>

@endsection
