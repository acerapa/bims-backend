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
        $matrix_distance            = \App\Http\Controllers\plugin_gps\MatrixDistance::getDistance("11.173259194540984,123.73126137252197", "11.1999448,123.740596");
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
        else if($matrix_distance['status'] !== 'OK') {
            return [
                "success"           => false,
                "message"           => "Customer address is invalid for distance calculation."
            ];
        }
        else if($matrix_distance['rows'][0]['elements'][0]['status'] == 'NOT_FOUND') {
            return [
                "success"           => false,
                "message"           => "Customer address was not found"
            ];
        }
        else {

            $dis_meter      = $matrix_distance['rows'][0]['elements'][0]['distance']['value'];
            $dis_klmtr      = round(($dis_meter / 1000), 1, PHP_ROUND_HALF_DOWN);
            
            $first_km_rate  = \App\Http\Controllers\plugin_order_placed\Config::var()['first_km_rate'];
            $next_km_rate   = \App\Http\Controllers\plugin_order_placed\Config::var()['next_km_rate'];

            if($dis_klmtr <= 1) {
                $del_fee    = $first_km_rate;
            }
            else{
                $a          = $dis_klmtr - 1;
                $b          = $a * $next_km_rate;
                $del_fee    = $first_km_rate + $b;
            }

            $total          = $cart_items['grand_total'] + $del_fee;

            $placed = DB::table("plugin_order_placed")->insert([
                "reference_id"          => $reference_id,
                "store_refid"           => $store_refid,
                "user_refid"            => $user_refid,
                "user_address_refid"    => $user_address_refid,
                "delivery_fee"          => $del_fee,
                "distance_matrix"       => json_encode($matrix_distance),
                "distance"              => $dis_klmtr,
                "total"                 => $total,
                "convo_refid"           => $convo_refid,
                "created_at"            => date("Y-m-d h:i:s"),
                "status"                => 1
            ]);

            if($placed) {

                $UpdateItems            = \App\Http\Controllers\plugin_order_item\EditItemPlaced::edit($reference_id, $user_refid, $store_refid);
                $NotifyStoreStaff       = null; //TO DO

                return [
                    "success"           => true,
                    "message"           => "Order successfully placed",
                    "item_placed"       => $UpdateItems
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
