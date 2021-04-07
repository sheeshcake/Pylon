
@extends('home')

@section('styles')
    <link href="css/style.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-md-6 col-8 align-self-center">
                    <h3 class="page-title mb-0 p-0">TimeTrack</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Rooms</a></li>
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
                    @if($data["user"][0]["user_role"] == "client")
                        <a href="{{ route('newroom') }}" class="btn btn-primary mb-3">Add Room</a>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <h1>Room1</h1>
                        </div>
                    </div>

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


@endsection