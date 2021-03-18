<section id="portfolio" class="portfolio">

    <div class="container" data-aos="fade-up">

        <header class="section-header">
        <h2>Portfolio</h2>
        <p>Check our latest work</p>
        </header>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
        <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
            <li data-filter="*" class="filter-active">All</li>
            @foreach($data["portfoliocategories"] as $categories)
                <li data-filter=".filter-{{ $categories->id }}">{{ $categories->category_name }}</li>
            @endforeach
            </ul>
        </div>
        </div>

        <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">
            @foreach($data["portfolios"] as $portfolio)
            <div class="col-lg-4 col-md-6 portfolio-item filter-{{ $portfolio->category_id }}">
                <div class="portfolio-wrap">
                    <img src="{{ url('/') }}/assets/img/portfolio/{{ $portfolio->image_name }}" class="img-fluid" alt="">
                    <div class="portfolio-info">
                        <h4>{{ $portfolio->portfolio_name }}</h4>
                        <p>{{ $portfolio->category_name }}</p>
                        <div class="portfolio-links">
                        <a href="{{ url('/') }}/assets/img/portfolio/{{ $portfolio->image_name }}" data-gallery="portfolioGallery" class="portfokio-lightbox" title="{{ $portfolio->portfolio_name }}"><i class="bi bi-plus"></i></a>
                        <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        </div>

    </div>

</section><!-- End Portfolio Section -->