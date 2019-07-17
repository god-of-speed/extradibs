<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords"
        content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>
        @section('title') Flash @show
    </title>
    @section('styles')
    <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/ico/favicon.ico">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
        rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Dosis|Open+Sans+Condensed:300|Playfair+Display|Source+Sans+Pro&display=swap" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/horizontal-menu.css">
    {{-- <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/morris.css"> --}}
    <link rel="stylesheet" type="text/css" href="app-assets/fonts/simple-line-icons/style.css">
    {{-- <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css"> --}}
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <style>
        body{
            font-family: 'Source Sans Pro', sans-serif;
        }

        /* #login a:hover{
           opacity:0.5 !important;
        } */
        .navbar-header{
            top:0 !important;
        }
    </style>
    <!-- END Custom CSS-->
    @show
</head>

<body class="horizontal-layout horizontal-menu 2-columns   menu-expanded" data-open="hover" data-menu="horizontal-menu"
    data-col="2-columns">
    @section('nav')
    <!-- fixed-top-->
    <nav
        class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow navbar-static-top navbar-light navbar-brand-center">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-md-none mr-auto"><a
                            class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item">
                        <a class="navbar-brand" href="/">
                            <img class="brand-logo" alt="modern admin logo"
                                src="../../../app-assets/images/logo/logo.png">
                            <h3 class="brand-text">Extra Dibs</h3>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @show
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-dark navbar-without-dd-arrow navbar-shadow"
        role="navigation" data-menu="menu-wrapper">
        <div class="navbar-container main-menu-content" data-menu="menu-container">
            <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
                @auth
                @if(Request::path() == '/profile')
                <li class="nav-item active">
                @else
                <li class="nav-item">
                @endif
                    <a class="nav-link" href="/profile">
                        Hello, {{Auth::user()->username}}
                    </a>
                </li>
                @endauth
                @auth
                @if(Request::path() == '/dashboard')
                <li class="nav-item active">
                @else
                <li class="nav-item">
                @endif
                    <a class="nav-link" href="/dashboard">
                        Dashboard
                    </a>
                </li>
                @endauth
                @auth
                @if(Auth::user()->role == 'admin')
                @if(Request::path() == '/admin_panel')
                <li class="nav-item active">
                @else
                <li class="nav-item">
                @endif
                    <a class="nav-link" href="/admin_panel?filter=fresh">
                        Admin Panel
                    </a>
                </li>
                @endif
                @endauth
                @guest
                @if(Request::path() == '/login')
                <li class="nav-item active" id="login">
                @else
                <li class="nav-item" id="login">
                @endif
                    <a class="nav-link font-medium-3" style="color:rgb(166, 166, 166);" href="/login">
                    Login</a>
                </li>
                @endguest
            </ul>
        </div>
    </div>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <footer class="footer fixed-bottom footer-static footer-light navbar-shadow">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
            <span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2019 <a
                    class="text-bold-800 grey darken-2"
                    href="/" target="_blank">ExtraDibs
                </a>, All rights reserved. </span>
            <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">Hand-crafted & Made with <i
                    class="ft-heart pink"></i> from Nigeria</span>
        </p>
    </footer>
    @section('javascripts')
    <!-- BEGIN VENDOR JS-->
    <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script type="text/javascript" src="app-assets/vendors/js/ui/jquery.sticky.js"></script>
    {{-- <script type="text/javascript" src="app-assets/vendors/js/charts/jquery.sparkline.min.js"></script> --}}
    {{-- <script src="app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script> --}}
    {{-- <script src="app-assets/vendors/js/charts/raphael-min.js" type="text/javascript"></script> --}}
    {{-- <script src="app-assets/vendors/js/charts/morris.min.js" type="text/javascript"></script> --}}
    <script src="app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
    <script src="app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js" type="text/javascript">
    </script>
    {{-- <script src="app-assets/data/jvector/visitor-data.js" type="text/javascript"></script> --}}
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN MODERN JS-->
    <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="app-assets/js/core/app.js" type="text/javascript"></script>
    <script src="app-assets/js/scripts/customizer.js" type="text/javascript"></script>
    <!-- END MODERN JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    {{-- <script type="text/javascript" src="app-assets/js/scripts/ui/breadcrumbs-with-stats.js"></script> --}}
    {{-- <script src="app-assets/js/scripts/pages/dashboard-sales.js" type="text/javascript"></script> --}}
    <!-- END PAGE LEVEL JS-->
    @show
</body>

</html>
