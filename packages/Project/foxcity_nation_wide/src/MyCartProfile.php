<?php

namespace Project\Foxcity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * foxcity/mycartProfile/1/USR-033121093459-TCS/STR-05042023044205-QEN
 * \Project\Foxcity\MyCartProfile::get($json_file, $user_refid);
 */

class MyCartProfile extends Controller
{
    public static function get($json_file, $user_refid, $store_refid) {

        return [
            "store"                     => [
                "header"                => \App\Http\Controllers\plugin_store\FetchStoreHeader::get($json_file, $store_refid),
            ],
            "store_ship_del_method"     => \App\Http\Controllers\plugin_store_ship_del_method\Fetch::get($json_file, $store_refid),
            "customer"                  => [
                "header"                => \App\Http\Controllers\plugin_user\GetProfile::header($json_file, $user_refid),
                "address"               => []
            ],
            "cart_items"                => \App\Http\Controllers\plugin_order_item\FetchItems::get($user_refid, $store_refid, 0),
            "voucher"                   => [
                "claimed_vouchers"      => [],
                "store_vouchers"        => [],
                "foxcity_vouchers"      => []
            ],
            "hostlink"                  => env("FTP_SERVER_HOSTLINK_1")
        ];
    }
}