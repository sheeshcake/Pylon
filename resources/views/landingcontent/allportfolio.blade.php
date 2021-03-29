@extends('portfolio-layout')

@section('title')
Portfolios
@endsection

@section('breadcrumbs')

<div class="container">

<ol>
  <li><a href="/">Home</a></li>
  <li><a href="{{ route('pylonblog') }}">Portfolio</a></li>
</ol>
<h2>Portfolios</h2>

</div>

@endsection

@section('entry')
    @foreach ($data['portfolios'] as $portfolio)
        <article class="entry">

            <div class="entry-img">
            <img src="{{ url('/') }}/assets/img/portfolio/{{ $portfolio->image_name }}" alt="" class="img-fluid">
            </div>

            <h2 class="entry-title">
            <a href="{{ route('pylonportfolio') }}/{{ $portfolio->portfolio_id }}">{{ $portfolio->portfolio_name }}</a>
            </h2>

            <div class="entry-meta">
            <ul>
                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-single.html">{{ $portfolio->f_name . " " . $portfolio->l_name }}</a></li>
                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-single.html"><time>{{ date("F jS, Y", strtotime($portfolio->created_at)) }}</time></a></li>
                <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-single.html">12 Comments</a></li>
            </ul>
            </div>

            <div class="entry-content">
            {!! strip_tags(Str::limit($portfolio->portfolio_content, 300, $end='...')) !!}
            <div class="read-more">
                <a href="{{ route('pylonportfolio') }}/{{ $portfolio->portfolio_id }}">Read More</a>
            </div>
            </div>

        </article><!-- End blog entry -->
    @endforeach
@endsection

@section('recent')

@foreach($data["recent"] as $recent)    
    <div class="post-item clearfix">
        <img src="{{ url('/') }}/assets/img/blog/{{ $recent->blog_image }}" alt="">
        <h4><a href="{{ route('pylonblog') }}/{{ $recent->id }}">{{ $recent->blog_title }}</a></h4>
        <time>{{ date("F jS, Y", strtotime($recent->created_at)) }}</time>
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