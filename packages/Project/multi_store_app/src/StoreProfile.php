<?php

namespace Project\MultiStoreApp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * multistoreapp/storeProfile/STR-05042023044205-QEN
 * \Project\MultiStoreApp\StoreProfile::get($store_refid);
 * 
 */

class StoreProfile extends Controller
{
    public static function get($store_refid) {
    
        return [
            "header"                => StoreProfile::header($store_refid),
            "store_menu_group"      => StoreProfile::store_menu_group($store_refid),
            "global_category"       => StoreProfile::global_category(),
            "branches"              => null
        ];
    }

    public static function header($store_refid) {

        $file_path      = "multi_store_app/store_header_" . $store_refid .".json";
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

    public static function store_menu_group($store_refid) {
        
        $file_path      = "multi_store_app/store_menu_group_" . $store_refid .".json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if($json_exist) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {
            $data = \App\Http\Controllers\plugin_store_menu_group\Fetch::getAll(1, $store_refid);
            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data);
            return $data;
        }
    }

    public static function global_category() {
        
        $file_path      = "multi_store_app/global_category.json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if($json_exist) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {
            $data = \App\Http\Controllers\plugin_product_category_global\Fetch::all();
            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data);
            return $data;
        }
    }
}
