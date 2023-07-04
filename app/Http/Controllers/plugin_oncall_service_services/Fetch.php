<?php

namespace App\Http\Controllers\plugin_oncall_service_services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * \App\Http\Controllers\plugin_oncall_service_services\Fetch::method();
 * 
 */

class Fetch extends Controller
{
    public static function method($json_file) {

        $json_file      = intval($json_file);
        $file_path      = "plugin_oncall_service_services/masterlist.json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if(($json_exist) && ($json_file == 1)) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {
            $data = DB::table("plugin_oncall_service_services")
            ->where("status", 1)
            ->orderBy("service","asc")
            ->get();
            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data);
            return $data;
        }
    }
}
