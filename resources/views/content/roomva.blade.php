
@extends('home')

@section('styles')
    <link href="{{ url('/') }}/css/style.min.css" rel="stylesheet">
@endsection

@section('content')
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
                    <center>
                        <div class="alert alert-success">
                            <h6 id="clock-loggedin"></h6>
                        </div>
                        <div class="alert alert-success">
                            <h6 id="clock"></h6>
                        </div>
                    </center>
                    <div id="screenshot" class="row mx-auto">
                        <video autoplay width="600" class="col col-lg-8 col-md-12"></video>
                        <div class="col col-lg-4 col-md-12">
                            <div class="row">
                                <div class="alert alert-secondary">
                                    <h6>Screenshot Recorded</h6>
                                </div>
                                <div id="screenshotdata" class="overflow-auto" style="height: 500px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('timetrack') }}" class="btn btn-danger ml-auto">End Session</a>
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
                        <center>
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <br>
                            Loading Chats
                        </center>
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
<script src="{{ url('/') }}/assets/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ url('/') }}/js/app-style-switcher.js"></script>
<script src="{{ url('/') }}/js/waves.js"></script>
<script src="{{ url('/') }}/js/sidebarmenu.js"></script>
<script src="{{ url('/') }}/js/custom.js"></script>
<script>
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
    $("#room_name_input").on('input', function(){
        $(".room_name").text($(this).val());
    });
    $(window).bind("beforeunload",function(event) {
        return "leave?";
    });
    $(window).bind('unload', function () {
        let _token = $('meta[name="csrf-token"]').attr('content'); 
        $.ajax({
            url: "{{route('leave')}}",
            type: "POST",
            data: {
                "room_id": '{{$data["room"][0]["id"]}}', 
                "session_id": '{{$data["session_id"]}}',
                "_token": _token
            },
            success: function(d){
            }
        });
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
                if(data.length > 0){
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
                        setTimeout(() => {
                            getchats();
                            chatcounter = 1000;
                        }, chatcounter);
                    }else{
                        if(chatcounter <= 5000){
                            setTimeout(() => {
                                getchats();
                                chatcounter += 500;
                            }, chatcounter);
                        }
                    }
                }else{
                    $("#chat-container").text("Say \"HI!\"");
                    if(chatcounter <= 5000){
                        setTimeout(() => {
                            getchats();
                            chatcounter += 500;
                        }, chatcounter);
                    }
                }
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
        chatcounter = 1000;
    }


    

    $(document).ready(async function(displayMediaOptions){
        getchats();
        var hour = 0;
        var min = 0;
        var seconds = 1;
        var date = new Date();
        var startdate = "Start Date & Time: " + date.getDate() + "-"
                + (date.getMonth()+1)  + "-" 
                + date.getFullYear() + " @ "  
                + date.getHours() + ":"  
                + date.getMinutes() + ":" 
                + date.getSeconds();
        var captureStream;
        try {
            captureStream = await navigator.mediaDevices.getDisplayMedia(displayMediaOptions);
        } catch(err) {
            console.error("Error: " + err);
        }
        let _token = $('meta[name="csrf-token"]').attr('content'); 
        const video = document.querySelector("#screenshot video");
        const canvas = document.createElement('canvas');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas.getContext('2d').drawImage(video, 0, 0);
        if(video.srcObject = captureStream){
            var myInterval = setInterval(function(){
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                canvas.getContext('2d').drawImage(video, 0, 0);
                $("#screenshotdata").append(
                    '<div class="card"">' +
                    "<img class='img-fluid' class='card-img-top' src='" + canvas.toDataURL('image/png', 0.1) + "'>" +
                    '<div class="card-body">' +
                    '<h5 class="card-title">' + 
                    date.getDate() + "-" +
                    (date.getMonth()+1)  + "-" + 
                    date.getFullYear() + " " +
                    hour + ":" + min + ":" + seconds +
                    '</h5>' +
                    '</div>' +
                    '</div>'
                    );
                $.ajax({
                    url: "{{ route('update') }}",
                    type: "POST",
                    data: {
                        "image_data": canvas.toDataURL('image/jpeg', 0.1),
                        "room_id": '{{$data["room"][0]["id"]}}', 
                        "_token": _token
                    },
                    success: function(d){
                        console.log(d);
                    }
                });
            }, 1000);
            setInterval(() => {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                canvas.getContext('2d').drawImage(video, 0, 0);
                $.ajax({
                    url: "{{ route('refresh') }}",
                    method: "POST",
                    data:{
                        "room_id": '{{$data["room"][0]["id"]}}', 
                        "session_id": '{{$data["session_id"]}}',
                        image_data: canvas.toDataURL('image/png', 0.1),
                        "_token": _token
                    },
                    success: function(d){
                        console.log(d);
                    }
                });
            }, 15000);
        }
        setInterval(() => {
            seconds++;
            if(seconds == 60){
                seconds = 0;
                min++;
                if(min == 60){
                    min = 0;
                    hour++;
                }
            }
            $("#clock").text("Time Logged In: " + hour + ":" + min + ":" + seconds);
            $("#clock-loggedin").html("Session ID:{{$data['session_id']}}<br>" + startdate);
        }, 1000);
    });
</script>

@endsection