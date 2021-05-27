<!DOCTYPE html>
<html lang="en" class="loading">
  <!-- BEGIN : Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Col / Org</title>
    <link rel="apple-touch-icon" sizes="60x60" href="{{ url('/app-assets/img/ico/apple-icon-60.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('/app-assets/img/ico/apple-icon-76.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ url('/app-assets/img/ico/apple-icon-120.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ url('/app-assets/img/ico/apple-icon-152.png')}}">
    <link rel="shortcut icon" type="image/png" href="{{ url('/app-assets/img/ico/favicon.png')}}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <script src="{{ url('/app-assets/vendors/js/core/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
    <link href="{{ url('/app-assets/datatables/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ url('/app-assets/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <script src="{{ url('/app-assets/datatables/jquery.validate.js')}}"></script>
    <script src="{{ url('/app-assets/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ url('/app-assets/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script type="text/javascript" src="{{ url('/app-assets/buttons/dataTables.buttons.min.js')}}"></script>
    <script type="text/javascript" src="{{ url('/app-assets/buttons/buttons.bootstrap4.min.js')}}"></script>
    <script type="text/javascript" src="{{ url('/app-assets/buttons/jszip.min.js')}}"></script>
    <script type="text/javascript" src="{{ url('/app-assets/buttons/pdfmake.min.js')}}"></script>
    <script type="text/javascript" src="{{ url('/app-assets/buttons/vfs_fonts.js')}}"></script>
    <script type="text/javascript" src="{{ url('/app-assets/buttons/buttons.html5.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('/app-assets/buttons/buttons.bootstrap4.min.css')}}"/>
    
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Montserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('/app-assets/fonts/feather/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('/app-assets/fonts/simple-line-icons/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('/app-assets/fonts/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('/app-assets/vendors/css/perfect-scrollbar.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('/app-assets/vendors/css/prism.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('/app-assets/vendors/css/chartist.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('/app-assets/css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('/app-assets/vendors/css/toastr.css')}}">

    <style>
      table tr td:first-letter {
        text-transform: uppercase;
      }
      #id{
        display: none;
      }
      .dt-buttons{
        position: absolute;
        right: 50%;
      }
    </style>
    
  </head>
  
  <body data-col="2-columns" class=" 2-columns ">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">
      <div data-active-color="white" data-background-color="purple-bliss" data-image="{{ url('/app-assets/img/sidebar-bg/01.jpg')}}" class="app-sidebar">
       
        <div class="sidebar-header">
          <div class="logo clearfix"><a href="/home" class="logo-text float-left">
              <div class="logo-img"><img width="120%" src="{{ url('/app-assets/img/logos/logo.png')}}"/></div><span class="text align-middle">Col / Org</span></a><a id="sidebarToggle" href="javascript:;" class="nav-toggle d-none d-sm-none d-md-none d-lg-block"><i data-toggle="expanded" class="toggle-icon ft-toggle-right"></i></a><a id="sidebarClose" href="javascript:;" class="nav-close d-block d-md-block d-lg-none d-xl-none"><i class="ft-x"></i></a></div>
        </div>
      
        <div class="sidebar-content">
          <div class="nav-container">
            <ul id="main-menu-navigation" data-menu="menu-navigation" data-scroll-to-active="true" class="navigation navigation-main">
                <li class="nav-item"><a href="/home"><i class="ft-home"></i><span data-i18n="" class="menu-title">Dashboard</span></a>
                </li>
                <li class="nav-item"><a href="/articles"><i class="ft-file-text"></i><span data-i18n="" class="menu-title">Artilces</span></a>
                </li>
                <li class="nav-item"><a href="/auteurs"><i class="ft-user"></i><span data-i18n="" class="menu-title">Auteurs</span></a>
                </li>
                <li class="nav-item"><a href="/experts"><i class="ft-user"></i><span data-i18n="" class="menu-title">Experts</span></a>
                </li>
                <li class="nav-item"><a href="/participants"><i class="ft-users"></i><span data-i18n="" class="menu-title">Participants</span></a>
                </li>
                <li class="nav-item"><a href="/sessions"><i class="ft-calendar"></i><span data-i18n="" class="menu-title">Sessions</span></a>
                </li>
                @if(Auth::user()->is_admin == 1)
                <li class="nav-item"><a href="/users"><i class="ft-users"></i><span data-i18n="" class="menu-title">Utilisateurs</span></a>
                </li>
                @endif
            </ul>
          </div>
        </div>
        <div class="sidebar-background"></div>
       
      </div>

      <nav class="navbar navbar-expand-lg navbar-light bg-faded header-navbar">
        <div class="container-fluid">
          <div class="navbar-header">
          </div>
          <div class="navbar-container">
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
              <ul class="navbar-nav">
                <li class="nav-item mr-2 d-none d-lg-block"><a id="navbar-fullscreen" href="javascript:;" class="nav-link apptogglefullscreen"><i class="ft-maximize font-medium-3 blue-grey darken-4"></i>
                    <p class="d-none">fullscreen</p></a></li>
               
                <li class="dropdown nav-item"><a id="dropdownBasic3" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-toggle"><i class="ft-user font-medium-3 blue-grey darken-4"></i>
                    <p class="d-none">User Settings</p></a>
                  <div ngbdropdownmenu="" aria-labelledby="dropdownBasic3" class="dropdown-menu text-left dropdown-menu-right">
                    <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item"><i class="ft-power mr-2"></i><span>Logout</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>

      <div class="main-panel">
        <div class="main-content">
          <div class="content-wrapper">

            @yield('content')

          </div>
        </div>

        <footer class="footer footer-static footer-light">
          <p class="clearfix text-muted text-sm-center px-2"><span>Copyright  &copy; 2019 <a href=""  target="_blank" class="text-bold-800 primary darken-2">NOUFAIR </a>, All rights reserved. </span></p>
        </footer>

      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    
    <script src="{{ url('/app-assets/vendors/js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('/app-assets/vendors/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('/app-assets/vendors/js/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{ url('/app-assets/vendors/js/prism.min.js')}}" type="text/javascript"></script>
    <script src="{{ url('/app-assets/vendors/js/jquery.matchHeight-min.js')}}" type="text/javascript"></script>
    <script src="{{ url('/app-assets/vendors/js/screenfull.min.js')}}" type="text/javascript"></script>
    <script src="{{ url('/app-assets/vendors/js/pace/pace.min.js')}}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ url('/app-assets/vendors/js/chartist.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN APEX JS-->
    <script src="{{ url('/app-assets/js/app-sidebar.js')}}" type="text/javascript"></script>
    <script src="'{{ url('/app-assets/js/notification-sidebar.js')}}" type="text/javascript"></script>
    <script src="{{ url('/app-assets/js/customizer.js')}}" type="text/javascript"></script>
    <!-- END APEX JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ url('/app-assets/js/dashboard1.js')}}" type="text/javascript"></script>
    <script src="{{ url('/app-assets/js/components-modal.min.js')}}" type="text/javascript"></script>
    <script src="{{ url('/app-assets/vendors/js/toastr.min.js')}}" type="text/javascript"></script>

    <!-- END PAGE LEVEL JS-->
   
    <script>
        jQuery(function($) {
            var path = window.location.href; 
            $('ul a').each(function() {
                if (this.href === path) {
                    $(this).closest('li').addClass('active');
                }
            });
        });
    </script>
  </body>
  <!-- END : Body-->
</html>