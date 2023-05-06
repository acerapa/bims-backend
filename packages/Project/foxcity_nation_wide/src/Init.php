<?php

namespace Project\Foxcity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * foxcity/init
 * \Project\Foxcity\Init::global_category();
 * \Project\Foxcity\Init::recomended_store();
 * 
 */

class Init extends Controller
{
    public static function fetch() {
        return [
            "global_banner"     => Init::global_banner(),
            "global_category"   => Init::global_category(),
            "recomended_store"  => Init::recomended_store(),
            "popular_product"   => null,
            "notification"      => null,
            "message"           => null
        ];
    }

    public static function recomended_store() {
        
        $file_path      = "foxcity_nation_wide/recomended_store.json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if($json_exist) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {
            $data = \App\Http\Controllers\plugin_store\FetchRecomendedStore::reviewScore(8);
            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data);
            return $data;
        }
    }

    public static function global_banner() {
        
        $file_path      = "foxcity_nation_wide/global_banner.json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if($json_exist) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {
            $data = \App\Http\Controllers\plugin_banner\Fetch::get();
            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data);
            return $data;
        }
    }

    public static function global_category() {
        
        $file_path      = "foxcity_nation_wide/global_category.json";
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
