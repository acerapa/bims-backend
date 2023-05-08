<?php

namespace Project\MultiStoreApp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * multistoreapp/init/user_refid
 * 
 */

class Init extends Controller
{
    public static function getInitial() {
        return [
            "stores"        => Init::stores()
        ];
    }

    public static function getInitUser($user_refid) {
        return [
            "mycart"        => Init::mycart(),
            "order_status"  => Init::order_status(),
            "user_profile"  => Init::user_profile()
        ];
    }

    public static function stores() {

        $file_path      = "multi_store_app/stores.json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if($json_exist) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {
            $data = \App\Http\Controllers\plugin_store\FetchRecomendedStore::allOpen();
            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data);
            return $data;
        }
    }

    public static function mycart() {
        return null;
    }

    public static function order_status() {
        return null;
    }

    public static function user_profile() {
        return null;
    }
}
