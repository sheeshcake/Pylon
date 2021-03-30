<section id="team" class="team">

    <div class="container" data-aos="fade-up">

        <header class="section-header">
        <h2>Team</h2>
        <p>Meet our awesome team</p>
        </header>

        <div class="row gy-4">
            @foreach($data["users"] as $user)
                <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                    <div class="member">
                    <div class="member-img">
                        <img src="assets/img/team/{{ $user->user_image }}" class="img-fluid" alt="">
                        <div class="social">
                        <a href="{{ $user->user_twitter }}"><i class="bi bi-twitter"></i></a>
                        <a href="{{ $user->user_fb }}"><i class="bi bi-facebook"></i></a>
                        <a href="{{ $user->user_insta }}"><i class="bi bi-instagram"></i></a>
                        <!-- <a href=""><i class="bi bi-linkedin"></i></a> -->
                        </div>
                    </div>
                    <div class="member-info">
                        <h4>{{ $user->f_name . " " . $user->l_name }}</h4>
                        <span>{{ $user->user_position }}</span>
                    </div>
                    </div>
                </div>
            @endforeach


        </div>
        <div class="mt-5">
            <center>
                <a href="{{ route('pylonteam') }}" class="btn btn-primary d-inline-flex align-items-center justify-content-center align-self-center">
                    Tell Me More&nbsp;<i class="bi bi-arrow-right py-1"></i>
                </a>
            </center>
        </div>


    </div>
</section><!-- End Team Section -->