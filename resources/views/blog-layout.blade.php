<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pylon Global Online Solutions | @yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ url('/') }}/assets/img/favicon.png" rel="icon">
  <link href="{{ url('/') }}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ url('/') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ url('/') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ url('/') }}/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="{{ url('/') }}/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="{{ url('/') }}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="{{ url('/') }}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ url('/') }}/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: FlexStart - v1.1.1
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <div id="spinner">
        <div class="spin">
            <div class="spin">
                <div class="spin">
                    <div class="spin">
                        <div class="spin">
                            <div class="spin">
                                <div class="spin">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <link href="{{ url('/') }}/assets/css/loading_style.css" rel="stylesheet">
    </div>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <a href="/" class="logo d-flex align-items-center">
            <img src="{{ url('/') }}/assets/img/logo.png" alt="">
            
        </a>

        <nav id="navbar" class="navbar">
            <ul>
            <li><a class="nav-link scrollto active" href="/">Home</a></li>
            <li><a class="nav-link scrollto" href="/#about">About</a></li>
            <li class="dropdown"><a href="#"><span>Services</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                  @foreach($data["portfoliocategories"] as $category)
                      <li><a href="/pylonservices/{{ $category->id }}">{{ $category->category_name }}</a></li>
                  @endforeach
                </ul>
            </li>
            <li><a class="nav-link scrollto" href="{{ route('pylonportfolio') }}">Portfolio</a></li>
            <li><a class="nav-link scrollto" href="/#team">Team</a></li>
            <!-- <li><a href="blog.html">Blog</a></li> -->
            <li><a class="nav-link scrollto" href="/#contact">Contact</a></li>
            <li><a class="getstarted scrollto" href="/#about">Get Started</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        @yield('breadcrumbs')
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-8 entries">


            @yield('entry')

            

          </div><!-- End blog entries list -->

          <div class="col-lg-4">

            <div class="sidebar">

              <h3 class="sidebar-title">Search</h3>
              <div class="sidebar-item search-form">
                <form action="">
                  <input type="text">
                  <button type="submit"><i class="bi bi-search"></i></button>
                </form>
              </div><!-- End sidebar search formn-->

              <h3 class="sidebar-title">Categories</h3>
              <div class="sidebar-item categories">
                <ul>
                  @yield('categories')

                </ul>
              </div><!-- End sidebar categories-->

              <h3 class="sidebar-title">Recent Posts</h3>
              <div class="sidebar-item recent-posts">
                @yield('recent')
              </div><!-- End sidebar recent posts-->

              <h3 class="sidebar-title">Tags</h3>
              <div class="sidebar-item tags">
                <ul>
                    @yield('tags')

                </ul>
              </div><!-- End sidebar tags-->

            </div><!-- End sidebar -->

          </div><!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Single Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-info">
            <a href="index.html" class="logo d-flex align-items-center">
              <img src="{{ url('/') }}/assets/img/logo.png" alt="">
            </a>
            <p>Like and Follow us on: </p>
            <div class="social-links">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram bx bxl-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin bx bxl-linkedin"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              @foreach($data["portfoliocategories"] as $category)
                  <li><i class="bi bi-chevron-right"></i> <a href="/pylonservices/{{ $category->id }}">{{ $category->category_name }}</a></li>
              @endforeach
            </ul>
          </div>

          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
            <p>Benito Labao St. Roosevelt,<br>
            Brgy. Saray-Tibanga 9200 Iligan City <br>
            <strong>Tel No:</strong> (063) 228-4272 or (063) 302 9758<br>
            <strong>Email:</strong> pylonglobal@gmail.com<br>
            </p>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong></strong>. All Rights Reserved
      </div>
      
    </div>
  </footer>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="{{ url('/') }}/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
        <script src="{{ url('/') }}/assets/vendor/aos/aos.js"></script>
        <script src="{{ url('/') }}/assets/vendor/php-email-form/validate.js"></script>
        <script src="{{ url('/') }}/assets/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="{{ url('/') }}/assets/vendor/purecounter/purecounter.js"></script>
        <script src="{{ url('/') }}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
        <script src="{{ url('/') }}/assets/vendor/glightbox/js/glightbox.min.js"></script>

  <script src="{{ url('/') }}/assets/js/main.js"></script>

</body>

</html>