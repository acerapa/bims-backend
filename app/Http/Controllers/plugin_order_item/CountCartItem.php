<?php

namespace App\Http\Controllers\plugin_order_item;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * \App\Http\Controllers\plugin_order_item\CountCartItem::count($user_refid);
 * 
 */

class CountCartItem extends Controller
{
    public static function count($user_refid) {
        return DB::table("plugin_order_item")
        ->where([
            ["user_refid", $user_refid],
            ["status", 0]
        ])
        ->count();
    }
}
