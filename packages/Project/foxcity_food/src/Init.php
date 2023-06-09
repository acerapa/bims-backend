<?php

namespace Project\FoxcityFood;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * foxcity_food/init/USR-033121093459-TCS
 * 
 */

class Init extends Controller
{
    public static function init($json_file, $user_refid) {
        return [
            "user_refid"        => $user_refid,
            "user_info"         => [
                "header"            => \App\Http\Controllers\plugin_user\GetProfile::header($json_file, $user_refid),
                "cart_items"        => []
            ],
            "banner"            => \App\Http\Controllers\plugin_banner\Fetch::get("foxcity_food"),
            "cuisine"           => \App\Http\Controllers\plugin_product_cuisine\Fetch::get($json_file),
            "resto_popular"     => [],
            "resto_all"         => [],
            "hostlink"          => env("FTP_SERVER_HOSTLINK_1")
        ];
    }
}