
@extends('home')

@section('styles')
    <link href="{{ url('/') }}/css/style.min.css" rel="stylesheet">
@endsection

@section('content')
        <style>
            .video-grid{
                display: grid;
                grid-template-columns: repeat(auto-fill, 300px);
                grid-auto-rows: 300px;
                grid-gap: 1em;
            }
        </style>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0 room_name">{{ $data["room"][0]["room_name"] }}</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/timetrack">Rooms</a></li>
                                    <li class="breadcrumb-item room_name">{{ $data["room"][0]["room_name"] }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ $data["room"][0]["room_name"] }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="video-grid">
                                @foreach($data["roomdata"] as $user)
                                <div class="card">
                                    <img class="card-img-top" id="user_image_{{ $user['user_id'] }}" src="{{ url('/') }}/assets/img/offline.gif"> 
                                    <div class="card-body"> 
                                        <p class="card-title" id="user_name_{{ $user['user_id'] }}">{{ $user["f_name"] . ' ' . $user["l_name"] }}</p> 
                                        <button data-toggle="modal" data-target="#user-session-modal" class="btn btn-primary open-session" value="{{ $user['user_id'] }}">Open Sessions</button> 
                                    </div> 
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="modal fade" id="user-session-modal" tabindex="-1" role="dialog" aria-labelledby="user-name" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="user-name"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="chat-box" aria-live="polite" aria-atomic="true" style="position: fixed;right: 0;bottom: 0;z-index: 1030;">
            <div class="toast show">
                <div class="toast-header">
                    <div class="container">
                        <strong class="mr-auto">Chat</strong>
                        <button type="button" id="close-chat" value="open" class="close" aria-label="Close">
                            <i class="mdi mdi-window-minimize"></i>
                        </button>
                    </div>
                </div>
                <div class="toast-body chat-container" style="min-height: 450px;">
                    <div id="chat-container" class="chat border-0 m-0 p-0 position-relative" style="min-height: 400px; max-height: 400px; overflow-y: scroll;">
                        Loading Chats
                    </div>
                    <div class="d-flex">
                        <input type="text" id="chat_content" class="form-control">
                        <button onclick="sendChat()" class="btn btn-success w-25">Send</button>
                    </div>
                </div>
            </div>
        </div>
</div>



@endsection

@section('scripts')
<script src="{{ url('/') }}/assets/plugins/jquery/dist/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="{{ url('/') }}/js/app-style-switcher.js"></script>
<script src="{{ url('/') }}/js/waves.js"></script>
<script src="{{ url('/') }}/js/sidebarmenu.js"></script>
<script src="{{ url('/') }}/js/custom.js"></script>
<script src="http://cdn.jsdelivr.net/g/filesaver.js"></script>
<script>
    $("#room_name_input").on('input', function(){
        $(".room_name").text($(this).val());
    });
    $("#close-chat").click(function(){
        if($(this).val() == "open"){
            $('.toast-body').hide();
            $(this).html(
                '<i class="mdi mdi-window-maximize"></i>'
            );
            $(this).val("close");
        }else{
            $('.toast-body').show();
            $(this).html(
                '<i class="mdi mdi-window-minimize"></i>'
            );
            $(this).val("open");
        }

    });
    $('#chat_content').on("keyup", function(e) {
        if (e.keyCode == 13) {
            sendChat();
        }
    });
    var length = 0;
    function getchats(){
        $.ajax({
            url: "/chat",
            method: "GET",
            data: {
                room_id : "{{ $data['room'][0]['id'] }}"
            },
            success: function(d){
                var data = JSON.parse(d);
                if(length != data.length){
                    $("#chat-container").html("");
                    data.forEach(function(item){
                        console.log(item["user_id"] == "{{ auth()->user()->id }}");
                        if(item["user_id"] == "{{ auth()->user()->id }}"){
                            $("#chat-container").append(
                                '<div class="row m-0">' +
                                    '<div class="position-relative balon1 p-1 m-0 w-100" data-is="You - ' + item["ago"] + '">' +
                                        '<a class="float-right">' + item["chat_content"] + '</a>' +
                                    '</div>' +
                                '</div>'

                            );
                        }else{
                            $("#chat-container").append(
                                '<div class="row m-0">' +
                                    '<div class="position-relative balon2 p-1 m-0 w-100" data-is="' + item["f_name"] + ' - ' + item["ago"] + '">' +
                                        '<a class="float-left">' + item["chat_content"] + '</a>' +
                                    '</div>' +
                                '</div>'
                            );
                        }
                    });
                    length = data.length;
                    $('#chat-container').animate({scrollTop: $('#chat-container').prop("scrollHeight")}, 500);
                }
                setTimeout(() => {
                    getchats();
                }, 1000);
            }
        })

    }
    function sendChat(){
        let _token = $('meta[name="csrf-token"]').attr('content'); 
        $.ajax({
            url: "/chat",
            method: "POST",
            data:{
                room_id: "{{ $data['room'][0]['id'] }}",
                chat_content: $("#chat_content").val(),
                "_token": _token
            },
            success: function(d){
                $("#chat_content").val("");
            }
        });
    }
    refresh_data();
    getchats();
    function refresh_data(){
        $.ajax({
            url: "{{route('getupdate')}}",
            type: "GET",
            data: {
                "room_id": "{{$data['room'][0]['id']}}",
            },
            success: function(d){
                var data = JSON.parse(d);
                data.forEach(function(d){
                    $("#user_image_" + d["user_id"]).attr("src", d["realtime_image"]);
                });
            }
        });
    }
    var myInterval1 = setInterval(function(){
        refresh_data();
    }, 5000);
    $(document).on("click", ".open-session", function(){
        var user_id = $(this).val();
        $("#user-name").text($("#user_name_" + user_id).text());
        let _token = $('meta[name="csrf-token"]').attr('content'); 
        $.ajax({
            url: "{{ route('getsessions') }}",
            method: "POST",
            data:{
                "room_id": "{{$data['room'][0]['id']}}",
                "user_id": user_id,
                "_token": _token
            },
            success: function(d){
                $(".modal-body").text("");
                var data = JSON.parse(d);
                data.forEach(function(e){
                    $(".modal-body").append(
                        '<div class="card">' +
                            '<div class="card-body">' +
                                '<div class="row">' +
                                    '<div class="col">' +
                                        '<h3>Session ID: ' + e["session_id"]  + 
                                            '<br>Date: ' + e["created_at"] + 
                                            '<br>Time: ' + e["time_start"] + " to " + e["time_end"] +
                                            '<br>Duration: ' + e["duration"] +
                                        '</h3>' +
                                    '</div>' +
                                    '<div class="col-md-2">' +
                                        '<a href="/rooms/download/' + e["session_id"] + '" class="btn btn-primary mx-1">Download Session</a>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>'
                    );
                });
            }
        })
    });
</script>

@endsection