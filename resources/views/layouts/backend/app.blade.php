<!DOCTYPE html>
<html class="loading semi-dark-layout" lang="en" data-layout="semi-dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home - Vuexy - Bootstrap HTML admin template</title>
    <link rel="apple-touch-icon" href="{{asset('assets/backend/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/backend/app-assets/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/css/charts/apexcharts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/css/extensions/toastr.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/themes/semi-dark-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    {{-- <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/charts/chart-apex.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/extensions/ext-component-toastr.css"> --}}
    @yield('page_vendor_css')
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('icon.css')}}">
    <!-- END: Custom CSS-->

    <script src="{{asset('assets/backend/app-assets/vendors/js/vendors.min.js')}}"></script>
    
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
                </ul>
                <ul class="nav navbar-nav">
                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style" ><i class="ficon" data-feather="sun"></i></a></li>
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ml-auto">
                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">{{ Auth::user()->name }}  </span><span class="user-status">Admin</span></div><span class="avatar"> <img class="round" src="{{asset('assets/backend/app-assets/images/avatar.png')}}" alt="avatar" height="40" width="40"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="javascript:void(0);"><i class="mr-50" data-feather="user"></i> Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('backend.signout') }}"><i class="mr-50" data-feather="power"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="{{ route('index') }}">
                        <h2 class="text-white text-bold">autoga|vanni</h2>
                        <span class="text-white pull-right logo-sub-text">
                            autopesulad
                        </span>
                    </a>
                </li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item @php if($menu == 'home') echo 'active' @endphp"><a class="d-flex align-items-center" href="{{ route('admin') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Home">Orders</span></a>
                </li>
                {{-- <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Management Items</span><i data-feather="more-horizontal"></i> --}}
                <li class="nav-item @php if($menu == 'locations') echo 'active' @endphp"><a class="d-flex align-items-center" href="{{ route('admin.locations') }}"><i data-feather='map-pin'></i><span class="menu-title text-truncate" data-i18n="Home">Locations</span></a>
                </li>
                <li class="nav-item @php if($menu == 'services') echo 'active' @endphp"><a class="d-flex align-items-center" href="{{ route('admin.services') }}"><i data-feather='activity'></i><span class="menu-title text-truncate" data-i18n="Home">Services</span></a>
                </li>
                <li class="nav-item @php if($menu == 'vechiles') echo 'active' @endphp"><a class="d-flex align-items-center" href="{{ route('admin.vehicles') }}"><i data-feather='truck'></i><span class="menu-title text-truncate" data-i18n="Home">Vehicles</span></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        @if (Session::has('added'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div class="alert-body">
                    {{session('added')}}
                </div>
                <button type="button" class="close session-close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif (Session::has('updated'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <div class="alert-body">
                {{session('updated')}}
            </div>
            <button type="button" class="close session-close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @elseif (Session::has('deleted'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <div class="alert-body">
                {{session('deleted')}}
            </div>
            <button type="button" class="close session-close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @yield('content')
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2021<a class="ml-25" href="https://1.envato.market/pixinvent_portfolio" target="_blank">AutoGavanni</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->

    <script>
        var appUrl = "https://autogavanni.ee/Car_washing/public";
    </script>

    <!-- BEGIN: Vendor JS-->
    
    @yield('vendor_js')
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('assets/backend/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('assets/backend/app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>
    @yield('page_vendor_js')
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('assets/backend/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{asset('assets/backend/app-assets/js/core/app.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    @yield('page_js')
    <script src="{{asset('assets/backend/assets/js/scripts.js')}}"></script>

    <!-- END: Page JS-->
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
            $( document ).ready(function() {
                setTimeout(function() {
                    $('.session-close').trigger("click");
                }, 4000);
            });
        });
    </script>
</body>
<!-- END: Body-->

</html>