
@extends('home')

@section('styles')
    <link href="{{ url('/') }}/css/style.min.css" rel="stylesheet">
@endsection

@section('content')
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0 blog_title">New Blog</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/blogs">Blogs</a></li>
                                    <li class="breadcrumb-item blog_title">New Blog</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <form enctype="multipart/form-data" action="{{ route('addblog') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-10 col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="blog_title">New Blog</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title_input">Blog Title</label>
                                        <input type="text" class="form-control" id="title_input" value="New Blog" name="blog_title" maxlength="225" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" class="custom-file-input" name="blog_image" id="image_input" required>
                                        <label class="custom-file-label" for="image_input">Blog Image</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="content_input">Blog Content</label>
                                        <textarea name="blog_content" id="content_input" cols="30" rows="10" ></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="remarks_input">Blog Remarks</label>
                                        <input type="text" class="form-control" id="remarks_input" name="blog_remarks" maxlength="225" required>
                                    </div>
                                    <input type="submit" class="btn btn-success" value="Save"> 
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Tags</h3>
                                </div>
                                <div class="card-body">
                                @foreach($data["tags"] as $tag)
                                    <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="blog_tags[]" value="{{ $tag->id }}" id="tag_{{ $tag->id }}" >
                                        <label class="form-check-label" for="tag_{{ $tag->id }}">
                                            {{ $tag->tag_name }}
                                        </label>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h3>Categories</h3>
                                </div>
                                <div class="card-body">
                                @foreach($data["categories"] as $category)
                                    <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="blog_categories[]" value="{{ $category->id }}" id="category_{{ $category->id }}" >
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
        $(".blog_title").text($(this).val());
    });
</script>

@endsection