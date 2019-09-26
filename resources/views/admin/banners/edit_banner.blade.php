@extends('adminlayout.admin_design')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Bnner</a> <a href="#" class="current">edit banner</a> </div>
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
            <h5>Add banner</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/add-banner'.$bannerDetails->id)}}" name="edit_banner" id="edit_product" novalidate="novalidate" enctype="multipart/form-data">
            	{{ csrf_field()}}

              <div class="control-group">
                <label class="control-label"> Banner Image</label>
                <div class="controls">
                  <input type="file" name="image" id="image">
                  @if(!empty($bannerDetails->image))
                  <img src="{{asset('/images/backend_image/slides/large/'.$bannerDetails->image)}}" style="width: 40px;">|<a href="{{url('/admin/delete-product-image/'.$bannerDetails->id)}}">Delete</a>
                  @endif
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Title</label>
                <div class="controls">
                  <input type="text" name="title" id="title" value="{{$bannerDetails->title}}" >
                </div>
              </div>
              
              <div class="control-group">
                <label class="control-label">Link</label>
                <div class="controls">
                  <input type="text" name="link" id="link" value="{{$bannerDetails->title}}">
                </div>
              </div>
             
              
              
              <div class="control-group">
                <label class="control-label">Enable </label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1" @if($bannerDetails->status=='1') checked @endif>
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Edit Banner" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>

@endsection
