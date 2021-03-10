@extends('blog')

@section('title')
    Blog
@endsection

@section('breadcrumbs')

<div class="container">

<ol>
  <li><a href="/">Home</a></li>
  <li><a href="blog.html">Blog</a></li>
</ol>
<h2>Blog</h2>

</div>

@endsection

@section('entry')
    @foreach ($blogs as $blog)
        <article class="entry">

            <div class="entry-img">
            <img src="assets/img/blog/{{ $blog->blog_image }}" alt="" class="img-fluid">
            </div>

            <h2 class="entry-title">
            <a href="blog/{{ $blog->id }}">{{ $blog->blog_title }}</a>
            </h2>

            <div class="entry-meta">
            <ul>
                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-single.html">{{ $blog->f_name . " " . $blog->l_name }}</a></li>
                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-single.html"><time>{{ date("F jS, Y", strtotime($blog->created_at)) }}</time></a></li>
                <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-single.html">12 Comments</a></li>
            </ul>
            </div>

            <div class="entry-content">
            <p>
                Similique neque nam consequuntur ad non maxime aliquam quas. Quibusdam animi praesentium. Aliquam et laboriosam eius aut nostrum quidem aliquid dicta.
                Et eveniet enim. Qui velit est ea dolorem doloremque deleniti aperiam unde soluta. Est cum et quod quos aut ut et sit sunt. Voluptate porro consequatur assumenda perferendis dolore.
            </p>
            <div class="read-more">
                <a href="blog/{{ $blog->id }}">Read More</a>
            </div>
            </div>

        </article><!-- End blog entry -->
    @endforeach
@endsection