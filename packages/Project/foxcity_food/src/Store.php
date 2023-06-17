<?php

namespace Project\FoxcityFood;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * foxcity_food/store_profile/1/SFD-05082021064202-44U
 */

class Store extends Controller
{
    public static function profile($json_file, $store_refid) {
        $header = \App\Http\Controllers\plugin_store\FetchStoreHeader::get($json_file, $store_refid);
        return [
            "header"            => $header,
            "category_store"    => \App\Http\Controllers\plugin_store_menu_group\Fetch::getAll($json_file, $store_refid),
            "product_page_1"    => \App\Http\Controllers\plugin_product\Masterlist::byStoreMethod(["json_file" => $json_file,"store_refid" => $store_refid,"page"=>1]),
            "category_global"   => \App\Http\Controllers\plugin_product_category_global\Fetch::all(),
            "addons"            => \App\Http\Controllers\plugin_product_addons\Fetch::allByStore($json_file, $store_refid),
            "followers"         => [
                "number"        => $header['followers'],
                "string"        => \App\Http\Controllers\plugin_utility\NumberAbbreviation::shorten($header['followers'])
            ],
            "staff"             => [],
            "hostlink"          => env("FTP_SERVER_HOSTLINK_1")
        ];
    }
}