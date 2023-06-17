<?php

namespace App\Http\Controllers\plugin_product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * \App\Http\Controllers\plugin_product\Fetch::header($json_file, $product_refid);
 */

class Fetch extends Controller
{
    public static function header($json_file, $product_refid) {

        $file_path      = "plugin_product/header-".$product_refid.".json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        $data_json      = [];
        
        if(($json_exist) && ($json_file == 1)) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {
            $data = DB::table("plugin_product")->where("reference_id", $product_refid)->get();
            if(count($data) > 0) { $data_json = $data[0]; }
            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data_json);
            return $data;
        }
    }
}
