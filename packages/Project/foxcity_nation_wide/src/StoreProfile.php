<?php

namespace Project\Foxcity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * foxcity/storeProfile?json_memory=0&store_refid=STR-05042023044205-QEN
 * \Project\Foxcity\StoreProfile::method([
 *      "store_refid"   => $store_refid,
 *      "json_memory"   => 0
 * ]);
 */

class StoreProfile extends Controller
{
    public static function get(Request $request) {
        return StoreProfile::method($request);
    }

    public static function method($request) {
        
        $store_refid    = $request['store_refid'];
        $json_memory    = $request['json_memory'];
        $file_path      = "foxcity_nation_wide/store_profile/". $store_refid .".json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);

        if(($json_exist) && ($json_memory == '1')) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {

            $header                 = \App\Http\Controllers\plugin_store\FetchStoreHeader::get($store_refid);

            $data = [
                "header"            => $header,
                "category_store"    => \App\Http\Controllers\plugin_store_menu_group\Fetch::getAll($store_refid),
                "category_global"   => \App\Http\Controllers\plugin_product_category_global\Fetch::all(),
                "branches"          => null,
                "addons"            => \App\Http\Controllers\plugin_product_addons\Fetch::allByStore($store_refid),
                "followers"         => [
                    "number"            => $header['followers'],
                    "string"            => \App\Http\Controllers\plugin_utility\NumberAbbreviation::shorten($header['followers'])
                ],
                "reviews_page_1"    => [],
                "hostlink"          => env("FTP_SERVER_HOSTLINK_1")
            ];
            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data);
            return $data;
        }
    }
}
