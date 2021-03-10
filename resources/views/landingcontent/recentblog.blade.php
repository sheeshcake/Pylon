<section id="recent-blog-posts" class="recent-blog-posts">

    <div class="container" data-aos="fade-up">

        <header class="section-header">
        <h2>Blog</h2>
        <p>Recent posts form our Blog</p>
        </header>

        <div class="row">
        @foreach ($data["blogs"] as $blog)
            <div class="col-lg-4">
                <div class="post-box">
                <div class="post-img"><img src="assets/img/blog/{{ $blog->blog_image }}" class="img-fluid" alt=""></div>
                <span class="post-date">{{ date("F jS, Y", strtotime($blog->created_at)) }}</span>
                <h3 class="post-title">{{ $blog->blog_title }}</h3>
                <a href="/blog/{{ $blog->id }}" class="readmore stretched-link mt-auto"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        @endforeach
        </div>

    </div>

</section><!-- End Recent Blog Posts Section -->