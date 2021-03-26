@extends('portfolio-layout')

@section('title')
    {{ $data['portfolio'][0]->portfolio_name }}
@endsection

@section('breadcrumbs')

<div class="container">

<ol>
  <li><a href="/">Home</a></li>
  <li><a href="{{ route('pylonportfolio') }}">Portfolios</a></li>
  <li>{{ $data['portfolio'][0]->portfolio_name }}</li>
</ol>
<h2>{{ $data['portfolio'][0]->portfolio_name }}</h2>

</div>

@endsection

@section('gallery')
<div class="col-lg-6">
    <div class="photo-gallery">
        <div class="container">
            <div class="photos row">
            @foreach($data["images"] as  $key => $images)
                @if($key == 0)
                <div class="row item">
                    <a href="{{ url('/') }}/assets/img/portfolio/{{ $images->image_name }}" data-lightbox="photos">
                        <img class="img-fluid item" src="{{ url('/') }}/assets/img/portfolio/{{ $images->image_name }}" style="width: 100%">
                    </a>
                </div>
                <div class="row">
                @else
                    <div class="col-4 item">
                        <a href="{{ url('/') }}/assets/img/portfolio/{{ $images->image_name }}" data-lightbox="photos">
                            <img class="img-fluid item" src="{{ url('/') }}/assets/img/portfolio/{{ $images->image_name }}" alt="">
                        </a>
                    </div>
                @endif
            @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('entry')
<div class="col-lg-6 entries">
    <article class="entry entry-single">

    <h2 class="entry-title">
    <a>{{ $data['portfolio'][0]->portfolio_name }}</a>
    </h2>

    <div class="entry-meta">
    <ul>
        <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-single.html">{{ $data['portfolio'][0]->f_name . " " . $data['portfolio'][0]->l_name }}</a></li>
        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-single.html"><time>{{ date("F jS, Y", strtotime($data['portfolio'][0]->created_at)) }}</time></a></li>
        <!-- <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-single.html">12 Comments</a></li> -->
    </ul>
    </div>

    <div class="entry-content">
    {!! $data['portfolio'][0]->portfolio_content !!}
    </div>

    <!-- <div class="entry-footer">
    <i class="bi bi-folder"></i>
    <ul class="cats">
        <li><a href="#">Business</a></li>
    </ul>

    <i class="bi bi-tags"></i>
    <ul class="tags">
        <li><a href="#">Creative</a></li>
        <li><a href="#">Tips</a></li>
        <li><a href="#">Marketing</a></li>
    </ul>
    </div> -->

    </article><!-- End blog entry -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
</div><!-- End blog entries list -->
@endsection


@section('recent')

@foreach($data["recent"] as $recent)    
    <div class="post-item clearfix">
        <img src="{{ url('/') }}/assets/img/blog/{{ $recent->blog_image }}" alt="">
        <h4><a href="{{ route('pylonblog') }}/{{ $recent->id }}">{{ $recent->blog_title }}</a></h4>
        <time>{{ date("F jS, Y", strtotime($data['blog'][0]->created_at)) }}</time>
    </div>
@endforeach

@endsection

@section('categories')

@foreach($data["categories"] as $category)
    <li><a href="#">{{ $category->category_name }}</a></li>
@endforeach

@endsection

@section('tags')

@foreach($data["tags"] as $tag)
    <li><a href="#">{{ $tag->tag_name }}</a></li>
@endforeach

@endsection