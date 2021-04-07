<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Auth;
use View;


class TimeTrackClientController extends Controller
{
    public function ShowRooms(){
        $user = User::where("id", "=", Auth::user()->id)->get();
        return view("content.rooms")->with("data", ["user" => $user]);
    }
}
