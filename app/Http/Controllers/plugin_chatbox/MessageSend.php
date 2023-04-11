<?php

namespace App\Http\Controllers\plugin_chatbox;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageSend extends Controller
{
    public static function sendText(Request $request) {
        return DB::table("plugin_chatbox_message")->insert([
            "convo_refid"       => $request['convo_refid'],
            "content_type"      => "TXT",
            "content_message"   => $request["content"],
            "created_by"        => $request['user_refid']
        ]);
    }
}
