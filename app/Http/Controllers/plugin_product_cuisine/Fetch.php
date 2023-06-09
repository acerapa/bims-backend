<?php

namespace App\Http\Controllers\plugin_product_cuisine;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * \App\Http\Controllers\plugin_product_cuisine\Fetch::get($json_file);
 * 
 */

class Fetch extends Controller
{
    public static function get($json_file) {
        
        $json_file      = intval($json_file);
        $file_path      = "plugin_product_cuisine/cuisine.json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if(($json_exist) && ($json_file == 1)) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {
            $source = DB::table("plugin_product_cuisine")
            ->select("reference_id as cuisine_refid","name","icon_path")
            ->where("status", 1)
            ->orderBy("name","asc")
            ->get();

            $data = [];
            for($i = 0; $i < count($source); $i++) {
                $data[] = [
                    "cuisine_refid"     => $source[$i]->cuisine_refid,
                    "name"              => $source[$i]->name,
                    "icon_path"         => "https://foxcityph.com/foxcity-fileserver/" . $source[$i]->icon_path
                ];
            }

            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data);
            return $data;
        }
    }
}
