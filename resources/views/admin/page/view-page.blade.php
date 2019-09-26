@extends('adminlayout.admin_design')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">category</a> </div>
    <h1>view categories</h1>
  </div>
  <div class="container-fluid">
    <hr>
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
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data table</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>page ID</th>
                  <th>Page Title</th>
                  <th>Page description</th>
                  <th>url</th>
                  <th>status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($pages as $page)
                <tr class="gradeX">
                  <td>{{$page->id}}</td>
                  <td>{{$page->title}}</td>
                  <td>{{$page->description}}</td>
                  <td>@if($page->status==1) Active @else Inactive @endif</td>

                  <td class="center"><a href="{{url('/admin/edit-category/'.$page->id)}}" class="btn btn-primary btn-mini">Edit</a> <a href="#" class="btn btn-success btn-mini">Publish</a> <a id="delCat" href="{{url('/admin/delete-category/'.$page->id)}}" class="btn btn-danger btn-mini">Delete</a></td>
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