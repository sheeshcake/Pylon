@extends('home')

@section('styles')
@section('styles')
        <!-- Vendor CSS Files -->
    <link href="{{ url('/') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ url('/') }}/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{ url('/') }}/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="{{ url('/') }}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
@endsection

@section('content')
<style>
    .create{
        background-image: url("{{ url('/') }}/assets/img/LoginBackground.jpg");
        height: 100vh;
        background-repeat: no-repeat;
        display: flex;
    }
</style>
<div class="create justify-content-center align-items-center" >
    <div class="col-md-3">
        <div class="card p-3" style="margin-bottom: 40%;border-color: #0cb0e6; border-width: thick;">
        <center>
            <h2 style="color:#133b7e">WELCOME BACK</h2>
            </center><br>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <!-- <label for="exampleInputEmail1">Username</label> -->
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
                </div><br>
                <div class="form-group">
                    <!-- <label for="exampleInputPassword1">Password</label> -->
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div><br>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                </div>
                <center>
                <button type="submit" class="btn btn-primary">Submit</button>
                </center>
            </form>
        </div>
    </div>
</div>


@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="{{ url('/') }}/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="{{ url('/') }}/assets/vendor/aos/aos.js"></script>
    <script src="{{ url('/') }}/assets/vendor/php-email-form/validate.js"></script>
    <script src="{{ url('/') }}/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/purecounter/purecounter.js"></script>
    <script src="{{ url('/') }}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/glightbox/js/glightbox.min.js"></script>
@endsection