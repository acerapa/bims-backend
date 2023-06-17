<?php

namespace App\Http\Controllers\plugin_photo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * \App\Http\Controllers\plugin_photo\Fetch::getByTagged($json_file, $tagged_refid);
 */

class Fetch extends Controller
{
    public static function getByTagged($json_file, $tagged_refid) {
        
        $file_path      = "plugin_photo/". $tagged_refid .".json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if(($json_exist) && ($json_file == 1)) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {
            $data = DB::table("plugin_photo")->where("tagged", $tagged_refid)->orderBy('dataid','desc')->get();
            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data);
            return $data;
        }
    }
}
