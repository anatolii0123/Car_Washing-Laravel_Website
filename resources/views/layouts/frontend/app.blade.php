<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>AutoWash - Car Wash Website Template</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Free Website Template" name="keywords">
        <meta content="Free Website Template" name="description">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Favicon -->

        {{-- <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"> 
        
        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset('icon.css')}}">
        <link href="{{asset('assets/frontend/lib/flaticon/font/flaticon.css')}}" rel="stylesheet">
        <link href="{{asset('assets/frontend/lib/animate/animate.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/frontend/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
        
        
        <!-- Template Stylesheet -->
        <link href="{{asset('assets/frontend/lib/timeslots/mark-your-calendar.css')}}" rel="stylesheet">
        <link href="{{asset('assets/frontend/css/booking.css')}}" rel="stylesheet"> --}}
        
        
        <link href="{{asset('assets/frontend/css/custom.css')}}" rel="stylesheet">
        <link href="{{asset('assets/frontend/css/style.css')}}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/bootstrap.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/bootstrap-datetimepicker.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/bootstrapValidator.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/select2.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/font-awesome.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/broneeri.css') }}">

        {{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> --}}
        {{-- <script src="{{asset('assets/frontend/lib/jQuery/jQuery-2.1.4.min.js')}}"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('assets/frontend/lib/easing/easing.min.js')}}"></script>
        <script src="{{asset('assets/backend/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
        <script src="{{asset('assets/frontend/lib/timeslots/mark-your-calendar.js')}}"></script>
        <script src="{{asset('assets/frontend/lib/momentjs/moment.js')}}"></script> --}}
        <script type="text/javascript" async="" src="{{ asset('assets/frontend/js/ga.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/mustache.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/jquery.mustache.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/hammer.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/jquery.hammer.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/moment.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/moment-timezone.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/bootstrap.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/bootstrap-datetimepicker.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/bootstrapValidator.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/select2.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/modernizr.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/JsTrans.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/dictionary-5de77a5290.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/polyfills.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/momentDate.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/index.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/events.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/fixedHeader.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/localStorage.js') }}"></script>
        <script src="{{asset('assets/frontend/lib/counterup/counterup.min.js')}}"></script>
        
    </head>

    <body>
        {{-- <!-- Top Bar Start -->
        <div class="top-bar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-12">
                        <div class="logo">
                            <a href="index.html">
                                <h1>Auto<span>Gavanni</span></h1>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7 d-none d-lg-block">
                        <div class="row">
                            <div class="col-4">
                                <div class="top-bar-item">
                                    <div class="top-bar-icon">
                                        <i class="far fa-clock"></i>
                                    </div>
                                    <div class="top-bar-text">
                                        <h3>Opening Hour</h3>
                                        <p>Mon - Fri, 8:00 - 9:00</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="top-bar-item">
                                    <div class="top-bar-icon">
                                        <i class="fa fa-phone-alt"></i>
                                    </div>
                                    <div class="top-bar-text">
                                        <h3>Call Us</h3>
                                        <p>+012 345 6789</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="top-bar-item">
                                    <div class="top-bar-icon">
                                        <i class="far fa-envelope"></i>
                                    </div>
                                    <div class="top-bar-text">
                                        <h3>Email Us</h3>
                                        <p>info@example.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top Bar End -->

        <!-- Nav Bar Start -->
        <div class="nav-bar">
            <div class="container">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
                    <a href="#" class="navbar-brand">MENU</a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto">
                            <a href="index.html" class="nav-item nav-link active">Home</a>
                            <a href="about.html" class="nav-item nav-link">About</a>
                        </div>
                        <div class="ml-auto">
                            <a class="btn btn-custom" href="#">Get Appointment</a>
                            <a class="btn btn-custom" href="{{ route('signin') }}">SignIn Admin</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div> --}}
        <!-- Nav Bar End -->

        @yield('content')


        <!-- Footer Start -->
        {{-- <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-contact">
                            <h2>Get In Touch</h2>
                            <p><i class="fa fa-map-marker-alt"></i>123 Street, New York, USA</p>
                            <p><i class="fa fa-phone-alt"></i>+012 345 67890</p>
                            <p><i class="fa fa-envelope"></i>info@example.com</p>
                            <div class="footer-social">
                                <a class="btn" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn" href=""><i class="fab fa-youtube"></i></a>
                                <a class="btn" href=""><i class="fab fa-instagram"></i></a>
                                <a class="btn" href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-link">
                            <h2>Popular Links</h2>
                            <a href="">About Us</a>
                            <a href="">Contact Us</a>
                            <a href="">Our Service</a>
                            <a href="">Service Points</a>
                            <a href="">Pricing Plan</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-link">
                            <h2>Useful Links</h2>
                            <a href="">Terms of use</a>
                            <a href="">Privacy policy</a>
                            <a href="">Cookies</a>
                            <a href="">Help</a>
                            <a href="">FQAs</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-newsletter">
                            <h2>Newsletter</h2>
                            <form>
                                <input class="form-control" placeholder="Full Name">
                                <input class="form-control" placeholder="Email">
                                <button class="btn btn-custom">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container copyright">
                <p>&copy; <a href="#">Your Site Name</a>, All Right Reserved. Designed By <a href="https://htmlcodex.com">HTML Codex</a></p>
            </div>
        </div> --}}
        <!-- Footer End -->
        
        <!-- Back to top button -->
        {{-- <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a> --}}
        
        <!-- Pre Loader -->
        <div id="loader" class="show">
            <div class="loader"></div>
        </div>
        <script>
            var appUrl = '{{ env('APP_URL') }}';
            $(function() {
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            })
        </script>       
        <!-- JavaScript Libraries -->
        @yield('vendor_js')
        <!-- Contact Javascript File -->
        
        <!-- Template Javascript -->
        <script src="{{asset('assets/frontend/js/main.js')}}"></script>
        <script src="{{asset('assets/frontend/js/jquery.cbs-plugin.js')}}"></script>
        <!-- Page Javascript -->
        @yield('page_js')
        <!-- End Page Javascript -->
    </body>
</html>
