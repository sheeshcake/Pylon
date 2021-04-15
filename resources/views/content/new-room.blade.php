
@extends('home')

@section('styles')
    <link href="{{ url('/') }}/css/style.min.css" rel="stylesheet">
@endsection

@section('content')
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0 room_name">New Room</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/timetrack">Rooms</a></li>
                                    <li class="breadcrumb-item room_name">New Rooms</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <form enctype="multipart/form-data" action="{{ route('addroom') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h3>New Room</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="room_name">Room Name</label>
                                <input type="text" id="room_name_input" class="form-control" name="room_name" value="New Room" required>                        
                            </div>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </div>
                </form>
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
    $("#room_name_input").on('input', function(){
        $(".room_name").text($(this).val());
    });
</script>

@endsection