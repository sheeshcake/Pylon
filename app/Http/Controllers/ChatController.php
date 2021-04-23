<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\Chats;
use Carbon\Carbon;

use Auth;


class ChatController extends Controller
{
    public function GetChats(Request $request){
        $chats = Chats::join("users", "users.id", "=", "chats.user_id")
                        ->where("room_id", "=", $request->room_id)
                        ->get(["chats.created_at as time", "chats.*", "users.*"])
                        ->toArray();
        foreach($chats as $index => $chat){
            $chats[$index]["ago"] = Carbon::now()->diffForHumans($chat["time"], true);
            $chats[$index]["time"] = Carbon::parse($chat["time"])->setTimezone('Asia/Singapore')->format("g:i A");
        }
        echo json_encode($chats);
    }

    public function SendChat(Request $request){
        $chat = new Chats();
        $chat->room_id = $request->room_id;
        $chat->user_id = Auth::user()->id;
        $chat->chat_content = $request->chat_content;
        if($chat->save()){
            return true;
        }
    }

}
