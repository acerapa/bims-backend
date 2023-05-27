<?php

namespace App\Http\Controllers\plugin_user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_user/getProfile/USR-033121093459-TCS
 * \App\Http\Controllers\plugin_user\GetProfile::header($user_refid);
 */

class GetProfile extends Controller
{
    public static function get($json_file = 1, $user_refid) {

        $profile            = GetProfile::header($json_file, $user_refid);
        
        if(count($profile) > 0) {
            
            $social_media   = GetProfile::social_media($json_file, $user_refid);
            $personalize    = GetProfile::personalize($json_file, $user_refid);
            $searches       = GetProfile::searches($json_file, $user_refid);

            return [
                "success"           => true,
                "profile"           => $profile[0],
                "social_media"      => $social_media,
                "personalize"       => $personalize,
                "searches"          => $searches
            ];
            
        }
        else {
            return [
                "success"           => false,
                "profile"           => [],
                "permissions"       => [],
                "social_media"      => [],
                "theme"             => [],
                "searches"          => []
            ];
        }
    }

    public static function header($json_file, $user_refid) {

        $file_path      = "plugin_user/". $user_refid .".json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if(($json_exist) && ($json_file == 1)) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {
            $data = DB::table("plugin_user")->select("reference_id","firstname","lastname","middlename","mobile","email","photo","access","status")->where("reference_id", $user_refid)->get();
            if(count($data) > 0) {
                $data_json = $data[0];
            }
            else {
                $data_json = [];
            }
            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data_json);
            return $data_json;
        }
    }

    public static function social_media($json_file, $user_refid) {
        
        $file_path      = "plugin_user_social_media/". $user_refid .".json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if(($json_exist) && ($json_file == 1)) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {
            $data = DB::table("plugin_user_social_media")->where("user_refid", $user_refid)->get();
            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data);
            return $data;
        }
    }

    public static function personalize($json_file, $user_refid) {
        
        $file_path      = "plugin_user_personalize/". $user_refid .".json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if(($json_exist) && ($json_file == 1)) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {
            $data = DB::table("plugin_user_personalize")->where("user_refid", $user_refid)->get();
            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data);
            return $data;
        }
    }

    public static function searches($json_file, $user_refid) {
        
        $file_path      = "plugin_user_search_history/". $user_refid .".json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if(($json_exist) && ($json_file == 1)) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {
            $data = [];
            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data);
            return $data;
        }
    }
}
