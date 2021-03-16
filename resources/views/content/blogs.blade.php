
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
                        <h3 class="page-title mb-0 p-0">Blogs</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Blogs</a></li>
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
                    <div class="col-lg-10 col-md-8">
                        <a href="{{ route('newblog') }}" class="btn btn-success mb-3">Add New Blog</a>
                        @foreach ($data['blogs'] as $blog)
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h3>{{ $blog->blog_title }}</h3>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="/blogs/removeblog/{{ $blog->id }}" class="btn btn-danger mx-1">Delete</a>
                                            <a href="/blogs/viewblog/{{ $blog->id }}" class="btn btn-primary mx-1">Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-lg-2 col md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3>Tags</h3>
                            </div>
                            <div class="card-body">
                                <div id="tag-alert" style="display: none"></div>
                                @foreach($data["tags"] as $tag)
                                    <div class="input-group">
                                        <input type="text" id="input_tag_{{ $tag->id }}" class="form-control" value="{{ $tag->tag_name }}">
                                        <div class="input-group-prepend input-group-append">
                                            <button class="btn btn-outline-success updatetag" value="{{ $tag->id }}">
                                                <i class="fa fa-refresh" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-danger deletetag" value="{{ $tag->id }}">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                                <hr>
                                <form action="tags/addtag" method="post">
                                    @csrf
                                    <label for="">Add Tag</label>
                                    <div class="input-group">
                                        <input type="text" name="tag_name" class="form-control" placeholder="Tag Name">
                                        <div class="input-group-append">
                                            <input type="submit" class="btn btn-outline-success" value="Add">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3>Categories</h3>
                            </div>
                            <div class="card-body">
                                <div id="category-alert" style="display: none"></div>
                                @foreach($data["categories"] as $category)
                                    <div class="input-group">
                                        <input type="text" id="input_cat_{{ $category->id }}" class="form-control" value="{{ $category->category_name }}">
                                        <div class="input-group-prepend input-group-append">
                                            <button class="btn btn-outline-success updatecat" value="{{ $category->id }}">
                                                <i class="fa fa-refresh" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-danger deletecat" value="{{ $category->id }}">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                                <hr>
                                <form action="categories/addcategory" method="post">
                                    @csrf
                                    <label for="">Add Category</label>
                                    <div class="input-group">
                                        <input type="text" name="category_name" class="form-control" placeholder="Category Name">
                                        <div class="input-group-append">
                                            <input type="submit" class="btn btn-outline-success" value="Add">
                                        </div>
                                    </div>
                                </form>
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
<script>
    $(document).ready(function(){
        setTimeout(() => {
            $(".alert").slideUp(500);
        }, 3000);
    });
    $(".updatecat").click(function(){
        var $id = $(this).val();
        $.ajax({
            url: "categories/updatecategory/" + $id,
            method: "POST",
            data: {
                category_name: $("#input_cat_" + $id).val(),
                "_token": "{{ csrf_token() }}"
            },
            success: function(d){
                $("#category-alert").addClass("alert alert-success").html(d).slideDown(500);
                $("#input_cat_" + $id).addClass("border border-success");
                setTimeout(() => {
                    $("#category-alert").slideUp(500);
                    $("#input_cat_" + $id).removeClass("border border-success");
                }, 3000);
            }
        });
    });
    $(".updatetag").click(function(){
        var $id = $(this).val();
        $.ajax({
            url: "tags/updatetag/" + $id,
            method: "POST",
            data: {
                tag_name: $("#input_tag_" + $id).val(),
                "_token": "{{ csrf_token() }}"
                },
            success: function(d){
                $("#tag-alert").addClass("alert alert-success").html(d).slideDown(500);
                $("#input_tag_" + $id).addClass("border border-success");
                setTimeout(() => {
                    $("#tag-alert").slideUp(500);
                    $("#input_tag_" + $id).removeClass("border border-success");
                }, 3000);
            }
        });
    });
    $(".deletetag").click(function(){
        $.ajax({
            url: "tags/removetag/" + $(this).val(),
            method: "GET",
            success: function(d){
                $("#tag-alert").addClass("alert alert-success").html(d).slideDown(500);
                setTimeout(() => {
                    $("#tag-alert").slideUp(500);
                    location.reload();
                }, 3000);
            }
        });
    });
    $(".deletecat").click(function(){
        $.ajax({
            url: "categories/removecategory/" + $(this).val(),
            method: "GET",
            success: function(d){
                $("#category-alert").addClass("alert alert-success").html(d).slideDown(500);
                setTimeout(() => {
                    $("#category-alert").slideUp(500);
                    location.reload();
                }, 3000);
            }
        });
    });
</script>

@endsection