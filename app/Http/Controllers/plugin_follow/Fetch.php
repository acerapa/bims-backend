<?php

namespace App\Http\Controllers\plugin_follow;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * \App\Http\Controllers\plugin_follow\Fetch::count($json_file, $target_refid);
 * 
 */

class Fetch extends Controller
{
    public static function count($json_file, $target_refid) {

        $file_path      = "plugin_follow/". $target_refid .".json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if(($json_exist) && ($json_file == 1)) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {
            $count = DB::table("plugin_follow")->where("target_refid", $target_refid)->count();
            $data = [
                "number"    => $count,
                "string"    => \App\Http\Controllers\plugin_utility\NumberAbbreviation::shorten($count)
            ];
            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data);
            return $data;
        }
    }

    public static function fetch($json_file, $target_refid) {
        return null;
    }
}
