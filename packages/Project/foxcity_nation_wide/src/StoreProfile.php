<?php

namespace Project\Foxcity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * foxcity/storeProfile?store_refid=STR-05042023044205-QEN
 */

class StoreProfile extends Controller
{
    public static function get(Request $request) {
    
        $store_refid = $request['store_refid'];

        return [
            "header"            => StoreProfile::header($store_refid),
            "category_store"    => StoreProfile::category($store_refid),
            "category_global"   => \Project\Foxcity\Init::global_category(),
            "branches"          => null
        ];
    }

    public static function header($store_refid) {

        $file_path      = "foxcity_nation_wide/store_header_" . $store_refid .".json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if($json_exist) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {
            $data = \App\Http\Controllers\plugin_store\FetchStoreHeader::get($store_refid);
            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data);
            return $data;
        }
    }

    public static function category($store_refid) {

        $file_path      = "foxcity_nation_wide/store_category_" . $store_refid .".json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if($json_exist) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {
            $data = \App\Http\Controllers\plugin_store_menu_group\Fetch::getAll($store_refid);
            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data);
            return $data;
        }
    }
}
