<!DOCTYPE html>
<html lang="en">
<head>
<title>Matrix Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap-responsive.min.css')}}" />
<link rel="stylesheet" href="{{ asset('css/backend_css/fullcalendar.css')}}" />
<link rel="stylesheet" href="{{ asset('css/backend_css/select2.css')}}" />
<link rel="stylesheet" href="{{ asset('css/backend_css/matrix-style.css')}}" />
<link rel="stylesheet" href="{{ asset('css/backend_css/matrix-media.css')}}" />
<link rel="stylesheet" href="{{ asset('css/backend_css/datepicker.css')}}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" />
<link href="{{ asset('fonts/backend_fonts/css/font-awesome.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/backend_css/css/jquery.gritter.css')}}" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
  <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->

  <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.js"></script> -->
  <!-- <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
 -->
</head>
<body>

@include('adminlayout.admin_header');
@include('adminlayout.admin_sidebar');
<!--close-top-serch-->

<!--sidebar-menu-->

<!--main-container-part-->
@yield('content')
<!--end-main-container-part-->

<!--Footer-part-->

@include('adminlayout.admin_footer');

<!--end-Footer-part-->


<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>


<script src="{{ asset('js/backend_js/jquery.min.js')}}"></script> 
<script src="{{ asset('js/backend_js/jquery.ui.custom.js')}}"></script> 
<script src="{{ asset('js/backend_js/bootstrap.min.js')}}"></script> 
<script src="{{ asset('js/backend_js/jquery.uniform.js')}}"></script> 
<script src="{{ asset('js/backend_js/select2.min.js')}}"></script> 
<script src="{{ asset('js/backend_js/jquery.validate.js')}}"></script> 
<script src="{{ asset('js/backend_js/jquery.dataTables.min.js')}}"></script> 
<script src="{{ asset('js/backend_js/matrix.js')}}"></script> 
<script src="{{ asset('js/backend_js/matrix.form_validation.js')}}"></script>
<script src="{{ asset('js/backend_js/matrix.tables.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="{{ asset('js/backend_js/matrix.popover.js')}}"></script>
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="{{ asset('js/backend_js/bootstrap-datepicker.js')}}"></script> 

</body>
</html>
