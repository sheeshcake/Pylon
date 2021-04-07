<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Auth;
use View;

class TimeTrackVAController extends Controller
{
    public function ShowRooms(){
        $user = User::where("id", "=", Auth::user()->id)->get();
        return view("content.rooms")->with("data", ["user" => $user]);
    }

    public function JoinRoom(Request $request){

    }

    public function LeaveRoom(Request $request){

    }

    public function UploadReport(Request $request){

    }

}
