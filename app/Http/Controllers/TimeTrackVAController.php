<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RoomUsers;
use App\Models\TimetrackRooms;
use App\Models\RoomSessions;
use App\Models\Screenshots;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Auth;
use View;

class TimeTrackVAController extends Controller
{
    public function ShowRooms(){
        $user = User::where("id", "=", Auth::user()->id)->get();
        $rooms = TimetrackRooms::all();
        RoomUsers::where("user_id", "=", Auth::user()->id)
        ->update([
            "is_online" => "offline"
        ]);
        RoomSessions::where("user_id", "=", Auth::user()->id)
                ->update([
                    "session_status" => "offline"
                ]);
        foreach(glob(Auth::user()->id . "-*.txt") as $index => $file){
            if(!is_dir($file)) { 
                $text = fopen($file, "w") or die("Unable to open file!");
                fwrite($text, URL::to('') . "/assets/img/offline.gif");
                fclose($text);
            }
        }
        return view("content.rooms")->with("data", [
                    "user" => $user,
                    "rooms" => $rooms
                    ]);
    }

    public function JoinRoom(Request $request){
        $room = TimetrackRooms::where("id", "=", $request->id)
                                ->get();
        $roomusers = new RoomUsers();
        $user = RoomUsers::where([
                ["user_id", "=", Auth::user()->id],
                ["room_id", "=", $request->id]
            ])->first();
        $user_session = new RoomSessions();
        $user_session->room_id =  $request->id;
        $user_session->user_id = Auth::user()->id;
        $user_session->session_status = "online";
        $user_session->session_time = Carbon::now();
        $user_session->save();
        if($user == null){
                $roomusers->user_id = Auth::user()->id;
                $roomusers->room_id = $request->id;
                $roomusers->is_online = "online";
                $roomusers->realtime_image = Auth::user()->id . "-" . $request->id . ".txt";
                $roomusers->save();
                $myfile = fopen(Auth::user()->id . "-" . $request->id . ".txt", "w");
        }else{
            RoomUsers::where("user_id", "=", Auth::user()->id)
                        ->update([
                            "is_online" => "online"
                        ]);
        }
        return view("content.roomva")->with("data",[
            "room" => $room,
            "session_id" => $user_session->id,
        ]);
    }



    public function LeaveRoom(Request $request){
        RoomUsers::where("user_id", "=", Auth::user()->id)
                ->update([
                    "is_online" => "offline"
                ]);
        RoomSessions::where("id", "=", $request->session_id)
                ->update([
                    "session_status" => "offline"
                ]);
        $myfile = fopen(Auth::user()->id . "-" . $request->room_id . ".txt", "w") or die("Unable to open file!");
        fwrite($myfile, URL::to('') . "/assets/img/offline.gif");
        fclose($myfile);
    }

    public function UploadReport(Request $request){
        $session = RoomSessions::where([
                ['user_id','=', Auth::user()->id],
                ['room_id', '=', $request->room_id],
                ['session_status', '=', 'online']
            ])->first();
        $screenshots = new Screenshots();
        $screenshots->session_id = $session->id;
        $screenshots->session_image = $request->image_data;
        $screenshots->save();
        RoomUsers::where("user_id", "=", Auth::user()->id)
                        ->update([
                            "is_online" => "online"
                        ]);
        echo "Updated!";
    }

    public function UpdateLastActivity(Request $request){
        RoomUsers::where("user_id", "=", Auth::user()->id)
                        ->update([
                            "is_online" => "online"
                        ]);
        RoomSessions::where("id", "=", $request->session_id)
                        ->update([
                        "session_status" => "online"
                    ]);
        $myfile = fopen(Auth::user()->id . "-" . $request->room_id . ".txt", "w") or die("Unable to open file!");
        fwrite($myfile, $request->image_data);
        fclose($myfile);
        echo "Updated!";
    }

}
