<?php

namespace App\Http\Controllers\plugin_order_item;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 
 * \App\Http\Controllers\plugin_order_item\EditItemPlaced::edit($place_refid, $user_refid, $store_refid);
 * \App\Http\Controllers\plugin_order_item\EditItemPlaced::updateStatus($place_refid, $new_status);
 * 
 */

class EditItemPlaced extends Controller
{
    public static function edit($place_refid, $user_refid, $store_refid) {
        return DB::table("plugin_order_item")
        ->where([
            ["user_refid", $user_refid],
            ["store_refid", $store_refid],
            ["status", 0]
        ])
        ->update([
            "order_placed_refid"    => $place_refid,
            "status"                => 1
        ]);
    }

    public static function updateStatus($place_refid, $new_status) {
        return DB::table("plugin_order_item")
        ->where("order_placed_refid", $place_refid)
        ->update([
            "status" => $new_status
        ]);
    }
}
