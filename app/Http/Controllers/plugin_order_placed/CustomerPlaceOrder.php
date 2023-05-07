<?php

namespace App\Http\Controllers\plugin_order_placed;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_order_placed/place?store_refid=STR-001&user_refid=USR-00167&user_address_refid=ADDRESS
 * 
 */

class CustomerPlaceOrder extends Controller
{
    public static function place(Request $request) {

        $reference_id               = \App\Http\Controllers\plugin_utility\CreateReferenceNo::create('PLC');
        $convo_refid                = \App\Http\Controllers\plugin_utility\CreateReferenceNo::create('CNV');
        
        $store_refid                = $request['store_refid'];
        $user_refid                 = $request['user_refid'];
        $user_address_refid         = $request['user_address_refid'];

        $store_profile              = \App\Http\Controllers\plugin_store\FetchStoreHeader::get($store_refid);
        $cart_items                 = \App\Http\Controllers\plugin_order_item\FetchItems::get($user_refid, $store_refid, 0);
        $user_address               = null;

        if($store_profile == null) {
            return [
                "success"           => false,
                "message"           => "Store information is not available at the moment."
            ];
        }
        else if(count($store_profile) <= 0 ) {
            return [
                "success"           => false,
                "message"           => "Store information was not found."
            ];
        }
        else if($cart_items['item_count'] == 0) {
            return [
                "success"           => false,
                "message"           => "You don't have item in your cart yet."
            ];
        }
        else {

            $placed = DB::table("plugin_order_placed")->insert([
                "reference_id"          => $reference_id,
                "store_refid"           => $store_refid,
                "user_refid"            => $user_refid,
                "user_address_refid"    => $user_address_refid,
                "delivery_fee"          => 0,
                "distance"              => 0,
                "total"                 => $cart_items['grand_total'],
                "convo_refid"           => $convo_refid,
                "created_at"            => date("Y-m-d h:i:s"),
                "status"                => 1
            ]);

            if($placed) {

                /**
                 * Notify store staff for new order
                 */

                return [
                    "success"           => true,
                    "message"           => "Order successfully placed"
                ];
            }
            else {
                return [
                    "success"           => false,
                    "message"           => "Something went wrong, try again later."
                ];
            }
        }
    }
}
