
@extends('home')

@section('styles')
    <link href="{{ url('/') }}/css/style.min.css" rel="stylesheet">
@endsection

@section('content')
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0 services_name">New Services</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/services">Services</a></li>
                                    <li class="breadcrumb-item services_name">New Services</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <form enctype="multipart/form-data" action="{{ route('addservices') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="services_name">New Services</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title_input">Services Name</label>
                                        <input type="text" class="form-control" id="title_input" value="New Services" name="category_name" maxlength="225" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="content_input">Services Content</label>
                                        <textarea name="category_content" id="content_input" cols="30" rows="10" ></textarea>
                                    </div>
                                    <input type="submit" class="btn btn-success" value="Save"> 
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
<script src="https://cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content_input');
    $("#title_input").on('input', function(){
        $(".services_name").text($(this).val());
    });
</script>

@endsection