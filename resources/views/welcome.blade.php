<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pylon Global Online Solutions</title>
        <meta content="" name="description">

        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="{{ url('/') }}/assets/img/favicon.png" rel="icon">
        <link href="{{ url('/') }}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Google Services -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfNafBUY8TVgLcPMCPISzgEVnSSEIU1XQ&callback=initMap"></script>

        <!-- Vendor CSS Files -->
        <link href="{{ url('/') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ url('/') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="{{ url('/') }}/assets/vendor/aos/aos.css" rel="stylesheet">
        <link href="{{ url('/') }}/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="{{ url('/') }}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
        <link href="{{ url('/') }}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="{{ url('/') }}/assets/css/style.css" rel="stylesheet">
    </head>
    <body class="antialiased" >
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

            <a href="#" class="logo d-flex align-items-center">
                <img src="{{ url('/') }}/assets/img/logo.png" alt="">
                
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                <li><a class="nav-link scrollto" href="#about">About</a></li>
                <li class="dropdown"><a href="#"><span>Services</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                    @foreach($data["portfoliocategories"] as $category)
                        <li><a href="/pylonservices/{{ $category->id }}">{{ $category->category_name }}</a></li>
                    @endforeach
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="#portfolio">Portfolio</a></li>
                <li><a class="nav-link scrollto" href="#team">Team</a></li>
                <li><a href="/pylonblog">Blog</a></li>
                <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                <li><a class="getstarted scrollto" href="#about">Get Started</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

            </div>
        </header><!-- End Header -->

        <!-- ======= Hero Section ======= -->
        <section id="hero" class="hero d-flex align-items-center">

            <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                <h1 class="mb-4" data-aos="fade-up">Business Simplified</h1>
                <h4 data-aos="fade-up" data-aos-delay="400">Simplifying business is all about utilizing the creative resources out there in the technology-advanced world, it implies that streamlining your business with digital advancement can make life a less of a headache for you and your business</h4>
                <div data-aos="fade-up" data-aos-delay="600">
                    <div class="text-center text-lg-start">
                    <a href="#about" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                        <span>Get Started</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                    </div>
                </div>
                </div>
                <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                <img src="{{ url('/') }}/assets/img/hero-img.png" class="img-fluid" alt="">
                </div>
            </div>
            </div>

        </section><!-- End Hero -->

        <main id="main">
            <!-- ======= About Section ======= -->
            @include('landingcontent.about')
            <div class="first-p " id="f">
                <div class="caption px-auto py-auto">
                    <div class="caption-box" data-aos="fade-up" data-aos-delay="600">
                        <h1>WHY PYLON?</h1>
                    </div>
                </div>
            </div>
            <!-- ======= Features Section ======= -->
            @include('landingcontent.feature')

            <!-- ======= Values Section ======= -->
            @include('landingcontent.values')

            <!-- ======= Counts Section ======= -->
            @include('landingcontent.counts')
            
            
            <!-- ======= Services Section ======= -->
            

            <!-- ======= Pricing Section ======= -->
            

            <!-- ======= F.A.Q Section ======= -->
            @include('landingcontent.faq')

            <!-- ======= Portfolio Section ======= -->
            @include('landingcontent.portfolio')

            <!-- ======= Testimonials Section ======= -->
            @include('landingcontent.testimonials')

            <!-- ======= Team Section ======= -->
            @include('landingcontent.team')

            <!-- ======= Recent Blog Posts Section ======= -->
            @include('landingcontent.recentblog')

            <!-- ======= Contact Section ======= -->
            @include('landingcontent.contact')

        </main><!-- End #main -->
        <!-- ======= Footer ======= -->
        @include('landingcontent.footer')

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
        
        <script>
        function initMap(){
            const myLatLng = { lat: 8.2317517, lng: 124.2369054 };
            map = new google.maps.Map(document.getElementById("map"), {
                center: myLatLng,
                zoom: 18,
            });
            new google.maps.Marker({
                position: myLatLng,
                map,
                title: "Hello World!",
            });
        }
        </script>
        <!-- Template Main JS File -->
        <script src="{{ url('/') }}/assets/js/main.js"></script>

    </body>
</html>
