
@extends('home')

@section('styles')
    <link href="{{ url('/') }}/css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
<div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">Portfolios</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Portfolios</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                @if (\Session::has('success'))
                    <div class="alert alert-success">{!! \Session::get('success') !!}</div>
                @endif
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <a href="{{ route('newportfolio') }}" class="btn btn-success mb-3">Add New Portfolio</a>
                        @foreach ($data['portfolios'] as $portfolio)
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h3>{{ $portfolio->portfolio_name }}</h3>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="/portfolio/removeportfolio/{{ $portfolio->id }}" class="btn btn-danger mx-1">Delete</a>
                                            <a href="/portfolio/viewportfolio/{{ $portfolio->id }}" class="btn btn-primary mx-1">Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
</div>

@endsection

@section('scripts')

<script src="{{ url('/') }}/assets/plugins/jquery/dist/jquery.min.js"></script>
<script src="{{ url('/') }}/assets/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ url('/') }}/js/app-style-switcher.js"></script>
<script src="{{ url('/') }}/js/waves.js"></script>
<script src="{{ url('/') }}/js/sidebarmenu.js"></script>
<script src="{{ url('/') }}/js/custom.js"></script>
<script>
    $(document).ready(function(){
        setTimeout(() => {
            $(".alert").slideUp(500);
        }, 3000);
    });


</script>

@endsection