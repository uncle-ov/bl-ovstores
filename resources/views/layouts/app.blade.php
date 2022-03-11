<!DOCTYPE html>
<html lang="en">
    <head>
        <title>OvStores - Get Clean Items ;-)</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('template/css/open-iconic-bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('template/css/animate.css') }}">
        
        <link rel="stylesheet" href="{{ asset('template/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('template/css/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('template/css/magnific-popup.css') }}">

        <link rel="stylesheet" href="{{ asset('template/css/aos.css') }}">

        <link rel="stylesheet" href="{{ asset('template/css/ionicons.min.css') }}">

        <link rel="stylesheet" href="{{ asset('template/css/bootstrap-datepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('template/css/jquery.timepicker.css') }}">

        
        <link rel="stylesheet" href="{{ asset('template/css/flaticon.css') }}">
        <link rel="stylesheet" href="{{ asset('template/css/icomoon.css') }}">
        <link rel="stylesheet" href="{{ asset('template/css/style.css') }}">
    </head>
    <body class="goto-here">
        @include('layouts.main_menu')
        @yield('content')

        <footer class="ftco-footer ftco-section">
            <div class="container">
            	<div class="row">
            		<div class="mouse">
						<a href="#" class="mouse-icon">
							<div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
						</a>
					</div>
            	</div>
                <div class="row mb-5">
                    <div class="col-md">
                        <div class="ftco-footer-widget mb-4">
                            <h2 class="ftco-heading-2">OvStores</h2>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
                            <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="ftco-footer-widget mb-4 ml-md-5">
                            <h2 class="ftco-heading-2">Menu</h2>
                            <ul class="list-unstyled">
                                <li><a href="#" class="py-2 d-block">Shop</a></li>
                                <li><a href="#" class="py-2 d-block">About</a></li>
                                <li><a href="#" class="py-2 d-block">Journal</a></li>
                                <li><a href="#" class="py-2 d-block">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                         <div class="ftco-footer-widget mb-4">
                            <h2 class="ftco-heading-2">Help</h2>
                            <div class="d-flex">
	                            <ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
	                                <li><a href="#" class="py-2 d-block">Shipping Information</a></li>
	                                <li><a href="#" class="py-2 d-block">Returns &amp; Exchange</a></li>
	                                <li><a href="#" class="py-2 d-block">Terms &amp; Conditions</a></li>
	                                <li><a href="#" class="py-2 d-block">Privacy Policy</a></li>
	                            </ul>
	                            <ul class="list-unstyled">
	                                <li><a href="#" class="py-2 d-block">FAQs</a></li>
	                                <li><a href="#" class="py-2 d-block">Contact</a></li>
	                            </ul>
	                        </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="ftco-footer-widget mb-4">
                        	<h2 class="ftco-heading-2">Have a Questions?</h2>
                        	<div class="block-23 mb-3">
	                            <ul>
	                                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
	                                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
	                                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
	                            </ul>
	                        </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">

                        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved <a href="https://instagram.com/uncle_ov" target="_blank">@uncle_ov</a>
						    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						</p>
                    </div>
                </div>
            </div>
        </footer>
        
    

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


    <script src="{{ asset('template/js/jquery.min.js') }}"></script>
    <script src="{{ asset('template/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('template/js/popper.min.js') }}"></script>
    <script src="{{ asset('template/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('template/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('template/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('template/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('template/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('template/js/aos.js') }}"></script>
    <script src="{{ asset('template/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('template/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('template/js/scrollax.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="{{ asset('template/js/google-map.js') }}"></script>
    <script src="{{ asset('template/js/main.js') }}"></script>
        
    </body>
</html>