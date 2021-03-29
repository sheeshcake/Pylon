
@extends('home')

@section('styles')
    <link href="{{ url('/') }}/css/style.min.css" rel="stylesheet">
@endsection

@section('content')
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">{{ $data['portfolio'][0]->portfolio_name }}</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/portfolio">Portfolio</a></li>
                                    <li class="breadcrumb-item">{{ $data['portfolio'][0]->portfolio_name }}</li>
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
                <form enctype="multipart/form-data" action="{{ route('updateportfolio') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-10 col-md-8">
                            <input type="text" hidden value="{{ $data['portfolio'][0]->id }}" name="portoflio_id">
                            <div class="card">
                                <div class="card-header">
                                    <h3>{{ $data['portfolio'][0]->portfolio_name }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title_input">Portoflio Name</label>
                                        <input type="text" class="form-control" id="title_input" value="{{ $data['portfolio'][0]->portfolio_name }}" name="portoflio_name" maxlength="225">
                                    </div>
                                    <div class="row">
                                        <h6>Portfolio Images</h6>
                                        <hr>
                                        <div id="portfolio_images">
                                            @foreach($data["portfolio_images"] as $image)
                                                <img src="{{ url('/') }}/assets/img/portfolio/{{$image->image_name}}">
                                            @endforeach
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" class="form-control-file" name="portfolio_image[]" id="image_input" required multiple>
                                        <label class="custom-file-label" for="image_input">Portfolio Image</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="content_input">Portfolio Content</label>
                                        <textarea name="portfolio_content" id="content_input" cols="30" rows="10" >{{ $data['portfolio'][0]->portfolio_content }}</textarea>
                                    </div>
                                    <input type="submit" class="btn btn-success" value="Save"> 
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Categories</h3>
                                </div>
                                <div class="card-body">
                                @foreach($data["categories"] as $category)
                                    <div class="form-check">
                                        @if(in_array($category->id, $data["portfoliocategory"]))
                                            <input class="form-check-input" type="radio" name="category_id" value="{{ $category->id }}" id="category_{{ $category->id }}" checked>
                                        @else
                                            <input class="form-check-input" type="radio" name="category_id" value="{{ $category->id }}" id="category_{{ $category->id }}" >
                                        @endif
                                        <label class="form-check-label" for="category_{{ $category->id }}">
                                            {{ $category->category_name }}
                                        </label>
                                    </div>
                                @endforeach
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
    $(document).ready(function(){
        setTimeout(() => {
            $(".alert").slideUp(500);
        }, 3000);
    });
</script>

@endsection