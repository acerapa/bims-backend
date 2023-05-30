<?php

namespace App\Http\Controllers\plugin_order_item;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * \App\Http\Controllers\plugin_order_item\FetchItems::get($user_refid, $store_refid, $status);
 * 
 */

class FetchItems extends Controller
{
    public static function get($user_refid, $store_refid, $status) {
        $items = DB::table("plugin_order_item")
        ->select("reference_id","product_refid","quantity","price","total","variant_info","add_ons_array","add_ons_total","grand_total")
        ->where([
            ["user_refid", $user_refid],
            ["store_refid", $store_refid],
            ["status", $status]
        ])
        ->get();

        if(count($items) > 0) {
            $total      = 0;
            $list       = [];
            foreach($items as $item) {
                $total      = $total + floatval($item->grand_total);
                $list[]     = [
                    "cart_item_refid"       => $item->reference_id,
                    "product_refid"         => $item->product_refid,
                    "quantity"              => floatval($item->quantity),
                    "price"                 => floatval($item->price),
                    "total"                 => floatval($item->total),
                    "variant_info"          => json_decode($item->variant_info),
                    "add_ons_array"         => json_decode($item->add_ons_array),
                    "add_ons_total"         => floatval($item->add_ons_total),
                    "grand_total"           => floatval($item->grand_total),
                ];
            }

            return [
                "items"         => $list,
                "item_count"    => count($items),
                "grand_total"   => $total
            ];
        }
        else {
            return [
                "items"         => [],
                "item_count"    => 0,
                "grand_total"   => 0
            ];
        }
    }
}
