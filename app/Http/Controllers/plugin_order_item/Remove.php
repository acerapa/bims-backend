<?php

namespace App\Http\Controllers\plugin_order_item;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_order_item/remove?reference_id=&user_refid=
 * App\Http\Controllers\plugin_order_item\Remove::remove($reference_id);
 * 
 */

class Remove extends Controller
{
    public static function remove(Request $request) {

        $reference_id   = $request['reference_id'];
        $user_refid     = $request['user_refid'];

        $removed = DB::table("plugin_order_item")
        ->where([
            ["reference_id", $reference_id],
            ["status", 0]
        ])
        ->delete();

        if($removed) {

            $cart_item_count            = \App\Http\Controllers\plugin_order_item\CountCartItem::count($user_refid);

            return [
                "success"               => true,
                "cart_item_count"       => $cart_item_count,
                "message"               => "Successfully removed"
            ];
        }
        else {
            return [
                "success"               => false,
                "message"               => "Unable to remove item"
            ];
        }
    }
}
