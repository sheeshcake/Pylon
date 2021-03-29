
@extends('home')

@section('styles')
    <link href="{{ url('/') }}/css/style.min.css" rel="stylesheet">
@endsection

@section('content')
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">{{ $data['services'][0]->category_name }}</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/services">Services</a></li>
                                    <li class="breadcrumb-item">{{ $data['services'][0]->category_name }}</li>
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
                <form enctype="multipart/form-data" action="{{ route('updateservices') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-10 col-md-8">
                            <input type="text" hidden value="{{ $data['services'][0]->id }}" name="id">
                            <div class="card">
                                <div class="card-header">
                                    <h3>{{ $data['services'][0]->category_name }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title_input">Services Name</label>
                                        <input type="text" class="form-control" id="title_input" value="{{ $data['services'][0]->category_name }}" name="category_name" maxlength="225">
                                    </div>
                                    <div class="form-group">
                                        <label for="content_input">Blog Content</label>
                                        <textarea name="category_content" id="content_input" cols="30" rows="10" >{{ $data['services'][0]->category_content }}</textarea>
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
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content_input');
    $(document).ready(function(){
        setTimeout(() => {
            $(".alert").slideUp(500);
        }, 3000);
    });
</script>

@endsection