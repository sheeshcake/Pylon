
@extends('home')

@section('styles')
    <link href="{{ url('/') }}/css/style.min.css" rel="stylesheet">
@endsection

@section('content')
        <div class="page-wrapper">
            <div class="container-fluid">
                @if (\Session::has('success'))
                    <div class="alert alert-success">{!! \Session::get('success') !!}</div>
                @endif
                <form enctype="multipart/form-data" action="{{ route('updateuser') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <input type="text" hidden value="{{ $data['user'][0]->id }}" name="id">
                            <div class="card">
                                <div class="card-header">
                                    <h3>{{ $data['user'][0]->f_name . " " . $data['user'][0]->l_name }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col">
                                            <label for="f_name">First Name</label>
                                            <input type="text" class="form-control" id="f_name" value="{{ $data['user'][0]->f_name }}" name="f_name" maxlength="225">
                                        </div>  
                                        <div class="form-group col">
                                            <label for="l_name">Last Name</label>
                                            <input type="text" class="form-control" id="l_name" value="{{ $data['user'][0]->l_name }}" name="l_name" maxlength="225">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col">
                                            <label for="user_fb">FB Link</label>
                                            <input type="text" class="form-control" id="user_fb" value="{{ $data['user'][0]->user_fb }}" name="user_fb" maxlength="225">
                                        </div>
                                        <div class="form-group col">
                                            <label for="user_insta">Insta Link</label>
                                            <input type="text" class="form-control" id="user_insta" value="{{ $data['user'][0]->user_insta }}" name="user_insta" maxlength="225">
                                        </div> 
                                        <div class="form-group col">
                                            <label for="user_twitter">Twitter Link</label>
                                            <input type="text" class="form-control" id="user_twitter" value="{{ $data['user'][0]->user_twitter }}" name="user_twitter" maxlength="225">
                                        </div> 
                                        <div class="form-group col">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" value="{{ $data['user'][0]->email }}" name="email" maxlength="225">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col">
                                            <label for="user_department">User Department</label>
                                            <input type="text" class="form-control" id="user_department" value="{{ $data['user'][0]->user_department }}" name="user_department" maxlength="225" required>
                                        </div>
                                        <div class="form-group col">
                                            <label for="user_position">User Position</label>
                                            <input type="text" class="form-control" id="user_position" value="{{ $data['user'][0]->user_position }}" name="user_position" maxlength="225">
                                        </div>
                                        <div class="form-group col">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" id="username" value="{{ $data['user'][0]->username }}" name="username" maxlength="225">
                                        </div> 
                                        <div class="form-group col">
                                            <label for="password">Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="password" value="{{ $data['user'][0]->plain_password }}" name="password" maxlength="225">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-outline-primary" id="show">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="form-group">
                                    <input type="file" class="form-control-file" name="user_image" id="image_input" required>
                                        <label class="custom-file-label" for="image_input">User Image</label>
                                    </div>
                                    <input type="submit" class="btn btn-success" value="Save"> 
                                </div>
                            </div>
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
    $show = false;
    $("#show").click(function(){
        if(!$show){
            $("#password").attr("type", "text");
            $(this).html('<i class="fa fa-eye-slash" aria-hidden="true"></i>');
            $show = true;
        }else{
            $("#password").attr("type", "password");
            $(this).html('<i class="fa fa-eye" aria-hidden="true"></i>');
            $show = false;
        }
        
    });
</script>

@endsection