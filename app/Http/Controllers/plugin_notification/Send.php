<?php

namespace App\Http\Controllers\plugin_notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * \App\Http\Controllers\plugin_notification\Send::send($user_refid, $message, $group, $payload);
 */

class Send extends Controller
{
    public static function send($user_refid, $message, $group, $payload) {
        /** Sent notif */
        return DB::table("plugin_notification")->insert([
            "user_refid"    => $user_refid,
            "message"       => $message,
            "group"         => $group,
            "payload"       => json_encode($payload)
        ]);
    }
}
