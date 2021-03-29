@extends('services-layout')

@section('title')
    {{ $data['services'][0]->category_name }}
@endsection

@section('breadcrumbs')

<div class="container">

<ol>
  <li><a href="/">Home</a></li>
  <li>{{ $data['services'][0]->category_name }}</li>
</ol>
<h2>{{ $data['services'][0]->category_name }}</h2>

</div>

@endsection

@section('entry')
<div class="col-lg-12 entries">
    <article class="entry entry-single">

    <h2 class="entry-title">
    <a>{{ $data['services'][0]->category_name }}</a>
    </h2>


    <div class="entry-content">
    {!! $data['services'][0]->category_content !!}
    </div>

    </article><!-- End blog entry -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
</div><!-- End blog entries list -->
@endsection


@section('recent')


@endsection

@section('categories')


@endsection

@section('tags')

@endsection