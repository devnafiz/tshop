@extends('adminlayout.admin_design')

@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Admin</a> </div>
    <h1>view Admins</h1>
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
            <h5>Admins</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Admin ID</th>
                 
                  <th>Admin title</th>
                  <th>Type</th>
                  <th>Role</th>
                 
                  
                  <th>Status</th>
                  <th>Create On</th>
                  
                  
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($admins as $admin)
                <?php if($admin->type=="Admin"){
                  $roles="All";
                }else{

                  $roles="";
                  if($admin->categories_access==1){
                    $roles.="Categories,";
                  }
                  if($admin->products_access==1){
                    $roles.="Products,";
                  }
                  if($admin->orders_access==1){
                    $roles.="Orders,";
                  }
                  if($admin->users_access==1){
                    $roles.="Users,";
                  }

                }?>
                <tr class="gradeX">
                  <td>{{$admin->id}}</td>
                  
                  <td>{{$admin->username}}</td>
                  <td>{{$admin->type}}</td>
                  <td>{{$roles}}</td>
                  
                   
                  
                  
                  <td>
                   @if($admin->status==1) Active @else Inactive @endif
                  </td>
                  <td>{{$admin->created_at}}</td>
                  
                  <td>
                  
                  </td>
                  <td class="center"><a href="{{url('/admin/edit-admin/'.$admin->id)}}" class="btn btn-primary btn-mini">Edit</a> 
                     
                    <a href="#myModal{{$admin->id}}" data-toggle="modal" class="btn btn-success btn-mini">View</a> <a rel="{{$admin->id}}"  rel1="delete-admin" <?php /* href="{{url('/admin/delete-product/'.$product->id)}}" */?> href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a></td>
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