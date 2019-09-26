@extends('adminlayout.admin_design')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">product</a> <a href="#" class="current">add product Images</a> </div>
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
            <h5>Add product Images</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/add-image/'.$productDetails->id)}}" name="add_image" id="add_image" novalidate="novalidate" enctype="multipart/form-data">
            	{{ csrf_field()}}
            	<input type="hidden" name="product_id" value="{{$productDetails->id}}">
              <div class="control-group">
                <label class="control-label">product Name</label>
                <label class="control-label">{{$productDetails->product_name}}</label>
                
              </div>
             
              <div class="control-group">
                <label class="control-label">product Code</label>
                <label class="control-label">{{$productDetails->product_code}}</label>
                
              </div>
              <div class="control-group">
                <label class="control-label">Image</label>
                <div class="controls">
                  <input type="file" name="image[]" id="image" multiple="multiple">
                </div>
              </div>
              
              
              <div class="form-actions">
                <input type="submit" value="Add image" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>


         <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>image table</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Image ID</th>
                  <th>Product ID</th>
                  
                  <th>image</th>
                  
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach($productImages as $image)
               <tr>
                <td>{{$image->id}}</td>
                <td>{{$image->product_id}}</td>
                <td><img src="{{ asset('/images/backend_image/products/small/'.$image->image)}}"></td>
                <td><a rel="{{$image->id}}"  rel1="delete-alt-image" <?php /* href="{{url('/admin/delete-product/'.$product->id)}}" */?> href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a></td>
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