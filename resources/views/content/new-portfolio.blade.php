
@extends('home')

@section('styles')
    <link href="{{ url('/') }}/css/style.min.css" rel="stylesheet">
@endsection

@section('content')
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0 portfolio_name">New Portfolio</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/blogs">Portfolio</a></li>
                                    <li class="breadcrumb-item portfolio_name">New Portfolio</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <form enctype="multipart/form-data" action="{{ route('addportfolio') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-10 col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="portfolio_name">New Portfolio</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title_input">Portfolio Name</label>
                                        <input type="text" class="form-control" id="title_input" value="New Portfolio" name="portfolio_name" maxlength="225" required>
                                    </div>
                                    <div class="row">
                                        <h6>Portfolio Images</h6>
                                        <hr>
                                        <div id="portfolio_images">
                                            <label class="text-danger">No Images Selected..</label>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" class="form-control-file" name="portfolio_image[]" id="image_input" required multiple>
                                        <label class="custom-file-label" for="image_input">Portfolio Image</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="content_input">Portfolio Content</label>
                                        <textarea name="portfolio_content" id="content_input" cols="30" rows="10" ></textarea>
                                    </div>
                                    <input type="submit" class="btn btn-success" value="Save"> 
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Categories</h3>
                                </div>
                                <div class="card-body">
                                @foreach($data["categories"] as $category)
                                    <div class="form-check">
                                            <input class="form-check-input" type="radio" name="category_id" value="{{ $category->id }}" id="category_{{ $category->id }}" required>
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
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content_input');
    $("#title_input").on('input', function(){
        $(".portfolio_name").text($(this).val());
    });
    $(function() {
        var imagesPreview = function(input, placeToInsertImagePreview) {
            if (input.files) {
                var filesAmount = input.files.length;
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        };
        $('#image_input').on('change', function() {
            $("#portfolio_images").html("");
            imagesPreview(this, 'div#portfolio_images');
        });
    });
</script>

@endsection