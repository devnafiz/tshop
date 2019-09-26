@extends('adminlayout.admin_design')

@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">products</a> </div>
    <h1>view products</h1>
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
            <h5>Products table</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>product ID</th>
                  <th>Product Name</th>
                  <th>Product category</th>
                  <th> Category name</th>
                  <th>product code</th>
                  <<th>product color</th>
                  <th>product price</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($products as $product)
                <tr class="gradeX">
                  <td>{{$product->id}}</td>
                  <td>{{$product->product_name}}</td>
                  <td>{{$product->category_id}}</td>
                  <td>{{$product->category_name}}</td>
                  <td>{{$product->product_code}}</td>
                  <td>{{$product->product_color}}</td>
                  <td>{{$product->price}}</td>
                  <td>
                  <img src="{{ asset('/images/backend_image/products/small/'.$product->image)}}" height="80" width="80">
                  </td>
                  <td class="center"><a href="{{url('/admin/edit-product/'.$product->id)}}" class="btn btn-primary btn-mini">Edit</a> <a href="{{url('/admin/add-attributes/'.$product->id)}}" class="btn btn-primary btn-mini">add attribute</a>
                     <a href="{{url('/admin/add-image/'.$product->id)}}" class="btn btn-primary btn-mini">add image</a>
                    <a href="#myModal{{$product->id}}" data-toggle="modal" class="btn btn-success btn-mini">View</a> <a rel="{{$product->id}}"  rel1="delete-product" <?php /* href="{{url('/admin/delete-product/'.$product->id)}}" */?> href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a></td>
                </tr>

                <div id="myModal{{$product->id}}" class="modal hide">
	              <div class="modal-header">
	                <button data-dismiss="modal" class="close" type="button">×</button>
	                <h3>{{$product->product_name}}</h3>
	              </div>
	              <div class="modal-body">
	                <p>Product ID:{{$product->id}}</p>
	                <p>Product name:{{$product->product_name}}</p>
	                <p>Product color:{{$product->product_color}}</p>
	                <p>Product code:{{$product->product_code}}</p>
	                <p>Product price:{{$product->price}}</p>

	              </div>
                </div>
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