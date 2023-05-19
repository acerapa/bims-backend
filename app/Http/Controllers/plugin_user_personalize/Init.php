<?php

namespace App\Http\Controllers\plugin_user_personalize;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * \App\Http\Controllers\plugin_user_personalize\Init::init($user_refid);
 * 
 */

class Init extends Controller
{
    public static function init($user_refid) {

        $count = Init::count($user_refid);

        if($count > 0) {
            return [ "success" => false ];
        }
        else {
            $created = DB::table("plugin_user_personalize")->insert(["user_refid" => $user_refid]);
            if($created) {
                return [ "success" => true ];
            }
            else {
                return [ "success" => false ];
            }
        }
    }

    public static function count($user_refid) {
        return DB::table("plugin_user_personalize")->where("user_refid", $user_refid)->count();
    }
}
