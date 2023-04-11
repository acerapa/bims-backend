<?php

namespace App\Http\Controllers\plugin_user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Local Call:
 * \App\Http\Controllers\plugin_user\Personalize::setTheme($user_refid, $theme);
 * 
 * API Call:
 * api/plugin_user/setTheme/USR-12302022065909-XXX/light
 * 
 */

class Personalize extends Controller
{
    public static function setTheme($user_refid, $theme) {

        $IsExist = \App\Http\Controllers\plugin_query\IsExist::isExist("plugin_user_personalize", [["user_refid","=",$user_refid]]);

        if($IsExist) {

            $updated = DB::table("plugin_user_personalize")->where("user_refid", $user_refid)->update(["theme" => $theme]);

            if($updated) {
                return [ "success" => true, "message" => "Theme successfully updated" ];
            }
            else {
                return [ "success" => false, "message" => "Theme update fail." ];
            }

        }
        else {

            $created = DB::table("plugin_user_personalize")->insert(["user_refid" => $user_refid, "theme" => $theme ]);

            if($created) {
                return [ "success" => true, "message" => "Theme successfully created" ];
            }
            else {
                return [ "success" => false, "message" => "Theme creation fail." ];
            }
        }  
    }
}
