
@extends('home')

@section('styles')
    <link href="../css/style.min.css" rel="stylesheet">
@endsection

@section('content')
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">{{ $blog[0]->blog_title }}</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('blogs') }}">Blogs</a></li>
                                    <li class="breadcrumb-item">{{ $blog[0]->blog_title }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                This is some text within a card block.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

@endsection

@section('scripts')

<script src="../../assets/plugins/jquery/dist/jquery.min.js"></script>
<script src="../../assets/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/app-style-switcher.js"></script>
<script src="../js/waves.js"></script>
<script src="../js/sidebarmenu.js"></script>
<script src="../js/custom.js"></script>


@endsection