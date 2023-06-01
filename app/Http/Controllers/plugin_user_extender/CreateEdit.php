<?php

namespace App\Http\Controllers\plugin_user_extender;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_user_extender/createEdit/USR-033121093459-TCS/firebase_token/123456
 * 
 */

class CreateEdit extends Controller
{
    public static function method($user_refid, $name, $value) {
        $exist = CreateEdit::exist($user_refid, $name);
        if($exist) {
            return DB::table("plugin_user_extender")
            ->where([
                ["user_refid", $user_refid],
                ["name", $name],
            ])
            ->update([
                "value"         => $value
            ]);
        }
        else {
            return DB::table("plugin_user_extender")
            ->insert([
                "user_refid"    => $user_refid,
                "name"          => $name,
                "value"         => $value
            ]);
        }
    }

    public static function exist($user_refid, $name) {
        $count = DB::table("plugin_user_extender")
        ->where([
            ["user_refid", $user_refid],
            ["name", $name]
        ])
        ->count();

        if($count > 0) {
            return true;
        }
        else {
            return false;
        }
    }
}
