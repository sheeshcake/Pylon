
@extends('home')

@section('styles')
    <link href="../css/style.min.css" rel="stylesheet">
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
                                    <li class="breadcrumb-item"><a href="{{ route('blogs') }}">Blogs</a></li>
                                    <li class="breadcrumb-item blog_title">New Blog</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <form enctype="multipart/form-data" action="{{ route('addblog') }}" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="blog_title">New Blog</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title_input">Blog Title</label>
                                        <input type="text" class="form-control" id="title_input" value="New Blog" name="blog_title" required>
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
                                        <input type="text" class="form-control" id="remarks_input" name="blog_remarks" required>
                                    </div>
                                    <input type="submit" class="btn btn-success" value="Save"> 
                                </div>
                            </div>
                        </form>
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
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content_input');
    $("#title_input").on('input', function(){
        $(".blog_title").text($(this).val());
    });
</script>

@endsection