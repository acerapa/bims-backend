<?php

namespace App\Http\Controllers\plugin_order_placed;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_order_placed/place?store_refid=&user_refid=&address_refid=&del_fee=&matrix_distance=&distance=&total=
 * 
 */

class CustomerPlaceOrder extends Controller
{
    public static function place(Request $request) {

        $reference_id               = \App\Http\Controllers\plugin_utility\CreateReferenceNo::create('PLC');
        $convo_refid                = \App\Http\Controllers\plugin_utility\CreateReferenceNo::create('CNV');
        
        $store_refid                = $request['store_refid'];
        $user_refid                 = $request['user_refid'];
        $user_address_refid         = $request['address_refid'];
        $del_fee                    = $request['del_fee'];
        $matrix_distance            = $request['matrix_distance'];
        $distance                   = $request['distance'];
        $total                      = $request['total'];
        
        $placed = DB::table("plugin_order_placed")->insert([
            "reference_id"          => $reference_id,
            "store_refid"           => $store_refid,
            "user_refid"            => $user_refid,
            "user_address_refid"    => $user_address_refid,
            "delivery_fee"          => $del_fee,
            "distance_matrix"       => $matrix_distance,
            "distance"              => $distance,
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
