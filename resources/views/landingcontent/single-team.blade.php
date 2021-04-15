@extends('team-layout')

@section('title')
Team
@endsection

@section('breadcrumbs')

<div class="container">

<ol>
  <li><a href="/">Home</a></li>
  <li><a href="{{ route('pylonteam') }}">Team</a></li>
</ol>
<h2>Team</h2>

</div>

@endsection

@section('entry')
    @php 
        $user_department = ""
    @endphp
    @foreach ($data['users'] as $user)
        @if($user->user_role != "client")
            @php
                if($user_department != $user->user_department)
                    echo '</div><center class="my-3"><h1>' . $user->user_department . '</h1></center><div class="row justify-content-center">';
            @endphp
            <div class="col-lg-3 col-md-6 mx-2 my-2" data-aos="fade-up" data-aos-delay="100">
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
            @php
                $user_department = $user->user_department
            @endphp
        @endif
    @endforeach


@endsection
