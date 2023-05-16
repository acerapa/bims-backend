<?php

namespace App\Http\Controllers\plugin_store_menu_group;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * \App\Http\Controllers\plugin_store_menu_group\Fetch::getAll($memory_json, $store_refid);
 * 
 */

class Fetch extends Controller
{
    public static function getAll($memory_json, $store_refid) {

        $file_path      = "plugin_store_menu_group/". $store_refid .".json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if(($json_exist) && ($memory_json == 1)) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {
            $data = DB::table("plugin_store_menu_group")
            ->select("reference_id", "store_refid","name","status")
            ->where([
                ["store_refid", $store_refid],
                ["status", 1]
            ])
            ->orderBy("name","ASC")
            ->get();
            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data);
            return $data;
        }
    }
}
