@extends('adminlayout.admin_design')

@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Bnner</a> </div>
    <h1>view banner</h1>
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
                  <th>Banner ID</th>
                  <th>Banner image</th>
                  <th>banner title</th>
                  <th>Banner link</th>
                  
                  <th>Status</th>
                  
                  
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($banners as $banner)
                <tr class="gradeX">
                  <td>{{$banner->id}}</td>
                  <td><img src="{{ asset('/images/frontend_image/banner/'.$banner->image)}}" height="80" width="80"></td>
                  <td>{{$banner->title}}</td>
                  <td>{{$banner->link}}
                   
                  </td>
                  
                  <td>
                   @if($banner->status==1) Active @else Inactive @endif
                  </td>
                  
                  
                  <td>
                  
                  </td>
                  <td class="center"><a href="{{url('/admin/edit-banner/'.$banner->id)}}" class="btn btn-primary btn-mini">Edit</a> 
                     
                    <a href="#myModal{{$banner->id}}" data-toggle="modal" class="btn btn-success btn-mini">View</a> <a rel="{{$banner->id}}"  rel1="delete-banner" <?php /* href="{{url('/admin/delete-product/'.$product->id)}}" */?> href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a></td>
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