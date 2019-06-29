<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;
use DB;
use \App\Http\Controllers\UserController as User;
use \App\Http\Controllers\AdminController as Admin;

class MessagingController extends Controller
{
    public function read($user_id, $sender) {
        //
    }
    public function send(Request $req) {
        $chat = new Chat;
        if($req->sendAs == "buyer") {
            $chat->sender = 1;
        }else {
            $chat->sender = 0;
        }
        $chat->user_id = $req->user_id;
        $chat->message = $req->message;
        $chat->sender = 1;
        $chat->save();
        return response()->json(['status' => 200, 'message' => 'message was sent']);
    }
    public function mine(Request $req) {
        $id = $req->user_id;

        $chat = Chat::where([['user_id', $id]])->orderBy('created_at', 'ASC')->get();

        return response()->json(['status' => 200, 'data' => $chat]);
    }

    public static function getChatList() {
        return Chat::with(['users'])
                    ->groupBy('user_id')
                    ->orderBy('chatting.created_at', 'ASC')
                    ->get();

        // return DB::table('chatting')
        //             ->join('users', 'chatting.user_id', '=', 'users.iduser')
        //             ->groupBy('user_id')
        //             ->orderBy('chatting.created_at', 'DESC')
        //             ->get();

                    // SELECT * FROM chatting LEFT JOIN users ON users.iduser = chatting.user_id GROUP BY user_id ORDER BY chatting.created_at DESC
    }
}
