<?php

namespace App\Http\Controllers\plugin_order_placed;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * NOTE: Not yet tested
 * api/plugin_order_item/storeSeenOrder?reference_id=
 */

class StoreSeenOrder extends Controller
{
    public static function seen($reference_id) {
        $seen = DB::table("plugin_order_placed")
        ->where([
            ["reference_id", $reference_id],
            ["status", 1]
        ])
        ->update([
            "store_seen"    => date("Y-m-d h:i:s"),
            "status"        => 3
        ]);

        if($seen) {

            /**
             * Notify customer
             */
            
            return [
                "success"   => true,
                "message"   => "Order seen by store"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Order is going well"
            ]; 
        }
    }
}
