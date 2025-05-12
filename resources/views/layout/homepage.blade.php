<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ana Food</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Vazir&display=swap" rel="stylesheet">
    

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
   
</head>
<body>

    @if ($errors->has('error'))
    <div class="alert alert-danger " style="direction: rtl; text-align: right;">
        {{ $errors->first('error') }}
    </div>
    @endif
    <nav class="navbar navbar-expand-lg" style="background-color: #a7c957; border-radius: 10px; margin-left: 0.5%; margin-right: 0.5%;">

        <div class="container-fluid">
          <a class="navbar-brand fw-bolder fs-3 text-white" href="#">AnaFood</a>

          <!-- سرچ بار و سبد خرید کنار هم -->
          <div class="d-flex align-items-center gap-3" style="margin-top: 10px;">
          
              <!-- search bar -->
              <form class="d-flex" action="{{ route('search') }}" method="GET">
                  <div class="input-group">
                      <input type="text" class="form-control" placeholder="search..." name="q">
                      <button class="btn btn-outline-secondary" type="submit">
                          <i class="bi bi-search"></i>
                      </button>
                  </div>
              </form>
          
              <!-- آیکون سبد خرید -->
              @if (Auth::user())
              <div style="position: relative;">
                  <a href="{{ route('basket.index') }}" class="text-white position-relative fs-4">
                      <i class="fa-solid fa-cart-shopping"></i>
                      @if ($basketcount > 0)
                          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                              {{ $basketcount }}
                          </span>
                      @endif
                  </a>
              </div>
              @endif
          
              <!-- آیکون کیف پول -->
              <!-- آیکون کیف پول همراه با توضیح و موجودی -->
                @if (Auth::user())
                <div class="d-flex align-items-center bg-white rounded-pill px-3 py-1" style="min-width: 200px;">
                    <i class="fa-solid fa-wallet text-success fs-5 me-2"></i>
                    <span class="text-dark fw-bold small me-2">
                         موجودی کیف پول: 
                    </span>
                    <span class="text-dark fw-bold small">
                        {{ number_format($walletbalance) }} تومان
                    </span>
                </div>
                @endif

          </div>
          
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('home') }}">HomePage</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-white" href="{{ route('logout') }}">Logout</a>
                  </li>
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
    <br>
    
    <!-- Remove the container if you want to extend the Footer to full width. -->
    <div>
        <!-- Footer -->
        <footer
            class="text-center text-lg-start text-white"
            style="background-color: #a7c957; border-radius: 10px; margin-left: 0.5%; margin-right: 0.5%;"
        >
            <!-- Grid container -->
            <div class="container p-4 pb-0">
                <!-- Section: Links -->
                <section class="">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                            <h6 class="text-uppercase mb-4 font-weight-bold">
                                Company name
                            </h6>
                            <p>
                                Here you can use rows and columns to organize your footer
                                content. Lorem ipsum dolor sit amet, consectetur adipisicing
                                elit.
                            </p>
                        </div>
                        <hr class="w-100 clearfix d-md-none" />
                        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                            <h6 class="text-uppercase mb-4 font-weight-bold">Products</h6>
                            <p>
                                <a class="text-white">MDBootstrap</a>
                            </p>
                            <p>
                                <a class="text-white">MDWordPress</a>
                            </p>
                            <p>
                                <a class="text-white">BrandFlow</a>
                            </p>
                            <p>
                                <a class="text-white">Bootstrap Angular</a>
                            </p>
                        </div>
                        <hr class="w-100 clearfix d-md-none" />
                        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                            <h6 class="text-uppercase mb-4 font-weight-bold">Useful links</h6>
                            <p>
                                <a class="text-white">Your Account</a>
                            </p>
                            <p>
                                <a class="text-white">Become an Affiliate</a>
                            </p>
                            <p>
                                <a class="text-white">Shipping Rates</a>
                            </p>
                            <p>
                                <a class="text-white">Help</a>
                            </p>
                        </div>
                        <hr class="w-100 clearfix d-md-none" />
                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                            <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
                            <p><i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
                            <p><i class="fas fa-envelope mr-3"></i> info@gmail.com</p>
                            <p><i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
                            <p><i class="fas fa-print mr-3"></i> + 01 234 567 89</p>
                        </div>
                    </div>
                </section>
                <hr class="my-3">
                <section class="p-3 pt-0">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-7 col-lg-8 text-center text-md-start">
                            <div class="p-3">
                                © 2020 Copyright:
                                <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
                            </div>
                        </div>
                        <div class="col-md-5 col-lg-4 ml-lg-0 text-center text-md-end">
                            <a class="btn btn-outline-light btn-floating m-1" role="button"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-floating m-1" role="button"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-floating m-1" role="button"><i class="fab fa-google"></i></a>
                            <a class="btn btn-outline-light btn-floating m-1" role="button"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </section>
            </div>
        </footer>
        <!-- Footer -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
