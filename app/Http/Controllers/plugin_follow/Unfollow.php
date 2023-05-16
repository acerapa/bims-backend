<?php

namespace App\Http\Controllers\plugin_follow;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_follow/unfollow?target_refid=STR-STORE&user_refid=USR-1223
 */

class Unfollow extends Controller
{
    public static function unfollow(Request $request) {
        $unfollowed = DB::table("plugin_follow")
        ->where([
            ["target_refid", $request['target_refid']],
            ["user_refid", $request['user_refid']]
        ])
        ->delete();

        if($unfollowed) {
            $followers = \App\Http\Controllers\plugin_follow\Fetch::count(0, $request['target_refid']);
            return [
                "success"   => true,
                "message"   => "Unfollowed successfully",
                "followers" => $followers
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Unable to unfollow"
            ];
        }
    }
}
