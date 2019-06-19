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
    <!-- END Custom CSS-->
    @show
</head>

<body class="horizontal-layout horizontal-menu 2-columns   menu-expanded" data-open="hover" data-menu="horizontal-menu"
    data-col="2-columns">
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
                        <a class="navbar-brand" href="index.html">
                            <img class="brand-logo" alt="modern admin logo"
                                src="../../../app-assets/images/logo/logo.png">
                            <h3 class="brand-text">Modern Admin</h3>
                        </a>
                    </li>
                    <li class="nav-item d-md-none">
                        <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i
                                class="la la-ellipsis-v"></i></a>
                    </li>
                </ul>
            </div>
            <div class="navbar-container content">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                                href="#"><i class="ft-menu"></i></a></li>
                        <li class="dropdown nav-item mega-dropdown"><a class="dropdown-toggle nav-link" href="#"
                                data-toggle="dropdown">Mega</a>
                            <ul class="mega-dropdown-menu dropdown-menu row">
                                <li class="col-md-2">
                                    <h6 class="dropdown-menu-header text-uppercase mb-1"><i
                                            class="la la-newspaper-o"></i> News</h6>
                                    <div id="mega-menu-carousel-example">
                                        <div>
                                            <img class="rounded img-fluid mb-1"
                                                src="../../../app-assets/images/slider/slider-2.png"
                                                alt="First slide"><a class="news-title mb-0" href="#">Poster Frame
                                                PSD</a>
                                            <p class="news-content">
                                                <span class="font-small-2">January 26, 2018</span>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-md-4">
                                    <h6 class="dropdown-menu-header text-uppercase mb-1"><i
                                            class="la la-envelope-o"></i> Contact Us</h6>
                                    <form class="form form-horizontal">
                                        <div class="form-body">
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-control-label" for="inputName1">Name</label>
                                                <div class="col-sm-9">
                                                    <div class="position-relative has-icon-left">
                                                        <input class="form-control" type="text" id="inputName1"
                                                            placeholder="John Doe">
                                                        <div class="form-control-position pl-1"><i
                                                                class="la la-user"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-control-label"
                                                    for="inputEmail1">Email</label>
                                                <div class="col-sm-9">
                                                    <div class="position-relative has-icon-left">
                                                        <input class="form-control" type="email" id="inputEmail1"
                                                            placeholder="john@example.com">
                                                        <div class="form-control-position pl-1"><i
                                                                class="la la-envelope-o"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-control-label"
                                                    for="inputMessage1">Message</label>
                                                <div class="col-sm-9">
                                                    <div class="position-relative has-icon-left">
                                                        <textarea class="form-control" id="inputMessage1" rows="2"
                                                            placeholder="Simple Textarea"></textarea>
                                                        <div class="form-control-position pl-1"><i
                                                                class="la la-commenting-o"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 mb-1">
                                                    <button class="btn btn-info float-right" type="button"><i
                                                            class="la la-paper-plane-o"></i> Send </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item nav-search"><a class="nav-link nav-link-search" href="#"><i
                                    class="ficon ft-search"></i></a>
                            <div class="search-input">
                                <input class="input" type="text" placeholder="Explore Modern...">
                            </div>
                        </li>
                    </ul>
                    @auth
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-user nav-item">
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <span class="mr-1">Hello,
                                    <span class="user-name text-bold-700">John Doe</span>
                                </span>
                                <span class="avatar avatar-online">
                                    <img src="../../../app-assets/images/portrait/small/avatar-s-19.png"
                                        alt="avatar"><i></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i
                                        class="ft-user"></i> Edit Profile</a>
                                <a class="dropdown-item" href="#"><i class="ft-mail"></i> My Inbox</a>
                                <a class="dropdown-item" href="#"><i class="ft-check-square"></i> Task</a>
                                <a class="dropdown-item" href="#"><i class="ft-message-square"></i> Chats</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i
                                        class="ft-power"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    @auth
    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-dark navbar-without-dd-arrow navbar-shadow"
        role="navigation" data-menu="menu-wrapper">
        <div class="navbar-container main-menu-content" data-menu="menu-container">
            <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="dropdown nav-item" data-menu="dropdown">
                    <a class="dropdown-toggle nav-link" href="index.html" data-toggle="dropdown"><i
                            class="la la-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    @endauth
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
            <span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2018 <a
                    class="text-bold-800 grey darken-2"
                    href="https://themeforest.net/user/pixinvent/portfolio?ref=pixinvent" target="_blank">PIXINVENT
                </a>, All rights reserved. </span>
            <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">Hand-crafted & Made with <i
                    class="ft-heart pink"></i></span>
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
