<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="icon" href="img/favicon.png" type="image/png" />
  <title>Eiser ecommerce</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" href="vendors/linericon/style.css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" />
  <link rel="stylesheet" href="css/themify-icons.css" />
  <link rel="stylesheet" href="css/flaticon.css" />
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css" />
  <link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css" />
  <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css" />
  <link rel="stylesheet" href="vendors/animate-css/animate.css" />
  <link rel="stylesheet" href="vendors/jquery-ui/jquery-ui.css" />
  <!-- main css -->
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/responsive.css" />
</head>

<body>
  <!--================Header Menu Area =================-->
  <header class="header_area">
    <div class="main_menu">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light w-100">
          <!-- Brand and toggle get grouped for better mobile display -->
          <a class="navbar-brand logo_h" href="/">
            <img src="img/logoo.png" width="200px" height="80px" alt="" />
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse offset w-100" id="navbarSupportedContent">
            <div class="row w-100 mr-0">
              <div class="col-lg-7 pr-0">
                <ul class="nav navbar-nav center_nav pull-right">
                  <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('/')}}">Home</a>
                  </li>
                  @guest

                  <li class="nav-item submenu dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false">
                            Login & Register <i class="fa fa-caret-down"></i>
                        </a>


                        <ul class="dropdown-menu">
                          @if (Route::has('register'))
                          <li class="nav-item {{ Request::is('register') ? 'active' : '' }}">
                              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                          </li>
                          @endif
        
                          @if (Route::has('login'))
                          <li class="nav-item {{ Request::is('login') ? 'active' : '' }}">
                              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                          </li>
                          @endif
                        </ul>
                </li>
    @else
                  <li class="nav-item submenu dropdown {{ Request::is('logout') ? 'active' : '' }}">
                      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                      aria-expanded="false">
                      @if (Auth::user()->profilePhoto != null)
                           <img class="rounded-img-small" src={{'img/'.Auth::user()->profilePhoto}}>
                      @else
                           <img  class="rounded-img-small" src="img/product/single-product/review-1.png" alt=""/> 
                      @endif   
                          {{ Auth::user()->name }} <i class="fa fa-caret-down"></i>
                      </a>


                      <ul class="dropdown-menu">
                        <li class="nav-item">
                          <a class="nav-link" href="{{url('profile')}}">My Profile</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{ url('my-orders?id='.Auth::user()->id) }}">My Orders</a>                        
                        </li>  
                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a>
                        </li>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                          </form>
                        </ul>
                  </li>
    @endguest
                  <li class="nav-item {{Request::is('categories') ? 'active' : ''}}">
                    <a class="nav-link" href="{{url('categories')}}">Categories</a>
                  </li>

                  <li class="nav-item submenu dropdown {{ Request::is('checkout') || Request::is('cart') ? 'active' : '' }}">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                      aria-expanded="false">Checkout</a>
                    <ul class="dropdown-menu">
                      <li class="nav-item">
                        <a class="nav-link" href="{{url('cart')}}">Shopping Cart</a>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link text-success" href="{{url('checkout')}}">Checkout</a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>

              <div class="col-lg-5 pr-0">
                <ul class="nav navbar-nav navbar-right right_nav pull-right">
                  <li class="nav-item">
                    <form action="search" method="GET" class="mt-4">
                      <div class="input-group">
                      <input type="text" name="query" id="query" value="{{ request()->input('query') }}"class="form-control border-end-0 border rounded-pill" placeholder="Search..">
                      <span class="input-group-append">
                        <button class="btn btn-outline-secondary bg-white border-start-0 border rounded-pill ms-n3" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                  </div>
                    </form>
                  </li>
                  <li class="nav-item" id="badger">
                    <a href="{{url('cart')}}" class="icons">
                      <i class="ti-shopping-cart"></i><span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </header>
  <!--================Header Menu Area =================-->

  @yield('content')


  <!--================ start footer Area  =================-->
  <footer class="footer-area section_gap">
    <div class="container">
      <div class="footer-bottom row align-items-center">
        <p class="footer-text m-0 col-lg-8 col-md-12"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
        <div class="col-lg-4 col-md-12 footer-social">
          Bazar On Facebook <a href="#"><i class="fa fa-facebook"></i></a>
        </div>
      </div>
    </div>
  </footer>
  <!--================ End footer Area  =================-->

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/stellar.js"></script>
  <script src="vendors/lightbox/simpleLightbox.min.js"></script>
  <script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
  <script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
  <script src="vendors/isotope/isotope-min.js"></script>
  <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="js/jquery.ajaxchimp.min.js"></script>
  <script src="vendors/counter-up/jquery.waypoints.min.js"></script>
  <script src="vendors/counter-up/jquery.counterup.js"></script>
  <script src="js/mail-script.js"></script>
  <script src="js/theme.js"></script>
  <script src="vendors/jquery-ui/jquery-ui.js"></script>
  @yield('scripts')
  @yield('reloadscript')
  @yield('deleteOrderScript')
  @yield('cartscript')
  @yield('singleProductScripts')
</body>

</html>