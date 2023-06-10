<?php

namespace Project\FoxcityFood;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * foxcity_food/init/0/USR-033121093459-TCS
 * 
 */

class Init extends Controller
{
    public static function init($json_file, $user_refid) {
        $city_code              = "072209";
        return [
            "user_refid"        => $user_refid,
            "user_info"         => [
                "header"            => \App\Http\Controllers\plugin_user\GetProfile::header($json_file, $user_refid),
                "cart_items"        => [],
                "city_info"         => []
            ],
            "banner"            => \App\Http\Controllers\plugin_banner\Fetch::get("foxcity_food"),
            "cuisine"           => \App\Http\Controllers\plugin_product_cuisine\Fetch::get($json_file),
            "resto_popular"     => \App\Http\Controllers\plugin_store\FetchRecomendedResto::method("FOOD", $city_code),
            "resto_all"         => \App\Http\Controllers\plugin_store\FetchAllResto::method("FOOD", $city_code),
            "hostlink"          => env("FTP_SERVER_HOSTLINK_1")
        ];
    }
}