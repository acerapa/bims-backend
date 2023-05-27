<?php

namespace Project\Foxcity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * foxcity/storeProfile?json_file=0&store_refid=STR-05042023044205-QEN
 * \Project\Foxcity\StoreProfile::method([
 *      "store_refid"   => $store_refid,
 *      "json_file"   => 0
 * ]);
 */

class StoreProfile extends Controller
{
    public static function get(Request $request) {
        return StoreProfile::method($request);
    }

    public static function method($request) {
        
        $store_refid    = $request['store_refid'];
        $json_file      = $request['json_file'];
        $file_path      = "foxcity_nation_wide/store_profile/". $store_refid .".json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);

        if(($json_exist) && ($json_file == '1')) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {

            $header                 = \App\Http\Controllers\plugin_store\FetchStoreHeader::get(1 , $store_refid);

            $data = [
                "header"            => $header,
                "category_store"    => \App\Http\Controllers\plugin_store_menu_group\Fetch::getAll($json_file, $store_refid),
                "product_page_1"    => \App\Http\Controllers\plugin_product\Masterlist::byStoreMethod(["json_file" => $json_file,"store_refid" => $store_refid,"page" => 1]),
                "category_global"   => \App\Http\Controllers\plugin_product_category_global\Fetch::all(),
                "branches"          => null,
                "addons"            => \App\Http\Controllers\plugin_product_addons\Fetch::allByStore($json_file, $store_refid),
                "followers"         => [
                    "number"            => $header['followers'],
                    "string"            => \App\Http\Controllers\plugin_utility\NumberAbbreviation::shorten($header['followers'])
                ],
                "staff"             => [],
                "hostlink"          => env("FTP_SERVER_HOSTLINK_1")
            ];
            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data);
            return $data;
        }
    }
}
