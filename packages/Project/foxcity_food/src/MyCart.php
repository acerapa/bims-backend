<?php

namespace Project\FoxcityFood;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * foxcity_food/mycart/1/USR-033121093459-TCS
 */

class MyCart extends Controller
{
    public static function get($json_file, $user_refid, $store_refid) {
        return [
            "user"          => \App\Http\Controllers\plugin_user\GetProfile::header($json_file, $user_refid),
            "user_address"  => \App\Http\Controllers\plugin_user_address_local\Fetch::get($json_file, $user_refid),
            "store"         => \App\Http\Controllers\plugin_store\FetchStoreHeader::get($json_file, $store_refid),
            "store_staff"   => [],
            "cart_items"    => \App\Http\Controllers\plugin_order_item\FetchItems::get($user_refid, $store_refid, 0),
        ];
    }
}