<?php

namespace App\Http\Controllers\plugin_follow;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_follow/follow?target_refid=STR-STORE&user_refid=USR-1223
 * 
 */

class Follow extends Controller
{
    public static function follow(Request $request) {

        $count = DB::table("plugin_follow")
        ->where([
            ["target_refid", $request['target_refid']],
            ["user_refid", $request['user_refid']]
        ])
        ->count();

        if($count <= 0) {

            $followed = DB::table("plugin_follow")->insert([
                "target_refid"  => $request['target_refid'],
                "user_refid"    => $request['user_refid']
            ]);
    
            if($followed) {
                $followers = \App\Http\Controllers\plugin_follow\Fetch::count(0, $request['target_refid']);
                return [
                    "success"   => true,
                    "message"   => "Successfully followed",
                    "followers" => $followers
                ];
            }
            else {
                return [
                    "success"   => false,
                    "message"   => "Unable to follow"
                ];
            }
        }
        else {
            return [
                "success"   => false,
                "message"   => "Already following"
            ];
        }
    
    }
}
