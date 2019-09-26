@extends('adminlayout.admin_design')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">product</a> <a href="#" class="current">add product attributes</a> </div>
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
            <h5>Add product Attributes</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/add-attributes/'.$productDetails->id)}}" name="add_attribute" id="add_attribute" novalidate="novalidate" enctype="multipart/form-data">
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
                <label class="control-label">product Color</label>
			                <div class="field_wrapper">
			    <div>
			        <input type="text" name="sku[]" id="sku" placeholder="SKU"  style="width: 120px" />
			        <input type="text" name="size[]" id="size" placeholder="size" style="width: 120px"/>
			        <input type="text" name="price[]" id="price" placeholder="Price" style="width: 120px"/>
			        <input type="text" name="stock[]" id="stock" placeholder="stock" style="width: 120px"/>
			        <a href="javascript:void(0);" class="add_button" title="Add field">add+</a>
			    </div>
			</div>
              </div>
              
              
              <div class="form-actions">
                <input type="submit" value="Add product" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>


         <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Products table</h5>
          </div>
          <div class="widget-content nopadding">
               <form action="{{ url('/admin/edit-attributes/'.$productDetails->id)}}" method="post">
                {{csrf_field()}}
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Attrributes ID</th>
                  <th>SKU</th>
                  <th>Size</th>
                  <th> price</th>
                  <th>Stock</th>
                  
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($productDetails['attributes'] as $attribute)
                <tr class="gradeX">
                  <td><input type="hidden" name="id[]" value="{{$attribute->id}}">{{$attribute->id}}</td>
                  <td>{{$attribute->sku}}</td>
                  <td>{{$attribute->size}}</td>
                  <td><input type="text" name="price[]" value="{{$attribute->price}}"></td>
                  <td><input type="text" name="stock[]" value="{{$attribute->stock}}"></td>
                  
                  <td class="center">
                    <input type="submit" value="Update" class="btn btn-mini btn-primary">
                    <a href="#myModal{{$attribute->id}}" data-toggle="modal" class="btn btn-success btn-mini">View</a> <a rel="{{$attribute->id}}"  rel1="delete-attribute"  href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a></td>
                </tr>

                
                @endforeach
                
              </tbody>
            </table>
           </form>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>

@endsection