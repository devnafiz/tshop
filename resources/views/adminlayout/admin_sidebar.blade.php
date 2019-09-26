<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li class="active"><a href="index.html"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <li> <a href="charts.html"><i class="icon icon-signal"></i> <span>Charts &amp; graphs</span></a> </li>
    <li> <a href="widgets.html"><i class="icon icon-inbox"></i> <span>Widgets</span></a> </li>
    <li><a href="tables.html"><i class="icon icon-th"></i> <span>Tables</span></a></li>
    <li><a href="grid.html"><i class="icon icon-fullscreen"></i> <span>Full width</span></a></li>
    @if(Session::get('adminDetails')['categories_access']==1)
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Categories</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="{{url('/admin/add-category')}}">add category</a></li>
        <li><a href="{{url('/admin/view-category')}}">View Category</a></li>
       
      </ul>
    </li>
    @endif
    @if(Session::get('adminDetails')['products_access']==1)
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Products</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="{{url('/admin/add-product')}}">add product</a></li>
        <li><a href="{{url('/admin/view-product')}}">View Product</a></li>
       
      </ul>
    </li>
@endif
     <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Coupons</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="{{url('/admin/add-coupon')}}">add Coupon</a></li>
        <li><a href="{{url('/admin/view-coupons')}}">View Coupon</a></li>
       
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Banner</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="{{url('/admin/add-banner')}}">add banner</a></li>
        <li><a href="{{url('/admin/view-banner')}}">View Coupon</a></li>
       
      </ul>
    </li>
     <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>page</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="{{url('/admin/add-page')}}">add page</a></li>
        <li><a href="{{url('/admin/view-page')}}">View Page</a></li>
       
      </ul>
    </li>
    </li>
    @if(Session::get('adminDetails')['type']=="Admin")
     <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Admin/sub Admin</span> <span class="label label-important"></span></a>
      <ul>
        <li><a href="{{url('/admin/add-admin')}}">add Admin</a></li>
        <li><a href="{{url('/admin/view-admin')}}">View Admin</a></li>
       
      </ul>
    </li>
    @endif
    <li><a href="buttons.html"><i class="icon icon-tint"></i> <span>Buttons &amp; icons</span></a></li>
    <li><a href="interface.html"><i class="icon icon-pencil"></i> <span>Eelements</span></a></li>
    <li class="submenu"> <a href="#"><i class="icon icon-file"></i> <span>Addons</span> <span class="label label-important">5</span></a>
      <ul>
        <li><a href="index2.html">Dashboard2</a></li>
        <li><a href="gallery.html">Gallery</a></li>
        <li><a href="calendar.html">Calendar</a></li>
        <li><a href="invoice.html">Invoice</a></li>
        <li><a href="chat.html">Chat option</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-info-sign"></i> <span>Error</span> <span class="label label-important">4</span></a>
      <ul>
        <li><a href="error403.html">Error 403</a></li>
        <li><a href="error404.html">Error 404</a></li>
        <li><a href="error405.html">Error 405</a></li>
        <li><a href="error500.html">Error 500</a></li>
      </ul>
    </li>
  
  </ul>
</div>