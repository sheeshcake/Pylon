<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TimetrackRooms;
use App\Models\RoomSessions;
use App\Models\Screenshots;

use Carbon\Carbon;
use Auth;
use View;
use ZipArchive;

class TimeTrackClientController extends Controller
{
    public function ShowRooms(){
        $rooms = TimetrackRooms::all();
        $user = User::where("id", "=", Auth::user()->id)->get();
        return view("content.rooms")->with("data", ["rooms" => $rooms, "user" => $user]);
    }


    public function ShowNewRoom(){
        return view("content.new-room");
    }

    public function AddRoom(Request $request){
        $newroom = new TimetrackRooms();
        $newroom->room_name = $request->room_name;
        $newroom->save();
        return redirect("/rooms/room/" . $newroom->id);
    }

    public function RemoveRoom(Request $request){
        TimetrackRooms::where("id", "=", $request->id)
                        ->delete();
        return redirect("/rooms");
    }

    public function JoinRoom(Request $request){
        $room = TimetrackRooms::where("id", "=", $request->id)
                            ->get();
        $roomdata = TimetrackRooms::join("room_users", "timetrack_rooms.id", "=", "room_users.room_id")
                                    ->join("users", "room_users.user_id", "=", "users.id")
                                    ->where("timetrack_rooms.id", "=", $request->id)
                                    ->get(["users.id as user_id", "timetrack_rooms.*", "room_users.*", "users.*"]);
        return view("content.roomclient")->with("data", [
            "room" => $room,
            "roomdata" => $roomdata
        ]);
    }

    public function GetUpdate(){
        $data = array();
        foreach(glob("*.txt") as $index => $file){
            if(!is_dir($file)) { 
                $name = explode("-", basename($file));
                $data[$index]["user_id"] = $name[0];
                $myfile = fopen($file, "r") or die("Unable to open file!");
                $data[$index]["realtime_image"] = fgets($myfile);
            }
        }
        echo json_encode($data);


    }

    public function GetSessions(Request $request){
        $sessions = RoomSessions::join("screenshots", "screenshots.session_id", "=", "room_sessions.id")
                            ->where([
                                    ["room_sessions.user_id", "=", $request->user_id],
                                    ["room_sessions.room_id", "=", $request->room_id],
                                    ["room_sessions.session_status", "=", "offline"]
                                ])
                            ->groupBy("room_sessions.id")
                            ->get()
                            ->toArray();
        foreach($sessions as $index => $session){
            $sessions[$index]["time_start"] = Carbon::parse($session["session_time"])->setTimezone('Asia/Singapore')->format("g:i A");
            $sessions[$index]["time_end"] = Carbon::parse($session["updated_at"])->setTimezone('Asia/Singapore')->format("g:i A");
            $startTime = Carbon::parse($session["session_time"]);
            $finishTime = Carbon::parse($session["updated_at"]);
            $sessions[$index]["duration"] = $finishTime->diffForHumans($startTime, true);
            $sessions[$index]["created_at"] = Carbon::parse($session["created_at"])->setTimezone('Asia/Singapore')->format("F d, Y");
        }
        echo json_encode($sessions);
    }

    public function DownloadSession($id){
        $data = Screenshots::where("session_id", "=", $id)
                            ->get()
                            ->toArray();
        $userdetails = RoomSessions::join("users", "users.id", "=", "room_sessions.user_id")
                                    ->where("room_sessions.id", "=", $id)
                                    ->get()
                                    ->toArray();
        $zip = new ZipArchive();
        $filename = $userdetails[0]["f_name"] . "-" . $userdetails[0]["l_name"] . "-" . $id . ".zip";
        if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
            echo("cannot open <$filename>\n");
        }else{
            $counter = 0;
            foreach($data as $files){
                $imagename = Carbon::parse($files["created_at"])->setTimezone('Asia/Singapore')->format("F d, Y g:i A") . ": " . $counter . ".jpg";
                $data1 = explode(',', $files["session_image"]);
                $bin = base64_decode($data1[1]);
                $im = imageCreateFromString($bin);
                imagejpeg($im, "temp" . $counter . ".jpg");
                imagedestroy($im);
                $zip->addFile("temp" . $counter . ".jpg", $imagename);
                $counter++;
                if(count($data) == $counter){
                    for($i = 0; $i < $counter; $i++){
                        unlink("temp" . $i . ".jpg");
                    }
                    $this->Download($filename);
                }
            }
            echo count($data) . "---" . $counter;
        }

    }

    private function Download($filename){
        header("Content-type: application/zip"); 
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-length: " . filesize($filename));
        header("Pragma: no-cache"); 
        header("Expires: 0"); 
        readfile("$filename");
        unlink($filename);
    }

}

