<?php

namespace App\Http\Controllers\plugin_user_extender;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_user_extender/getAll/USR-033121093459-TCS
 * plugin_user_extender/getSingle/USR-033121093459-TCS/firebase_token
 */

class Fetch extends Controller
{
    public static function getAll($user_refid) {
        return DB::table("plugin_user_extender")
        ->select("name","value")
        ->where("user_refid", $user_refid)
        ->get();
    }

    public static function getSingle($user_refid, $name) {
        $source = DB::table("plugin_user_extender")
        ->select("value")
        ->where([
            ["user_refid", $user_refid],
            ["name", $name],
        ])
        ->get();

        if(count($source) > 0) {
            return $source[0];
        }
        else {
            return null;
        }
    }
}
