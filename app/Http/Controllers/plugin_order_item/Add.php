<?php

namespace App\Http\Controllers\plugin_order_item;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_order_item/add?product_refid=&user_refid=&store_refid=&quantity=7&price=123&variant_info=&add_ons_array=&add_ons_total=56
 * 
 */

class Add extends Controller
{
    public static function add(Request $request) {

        $reference_id   = \App\Http\Controllers\plugin_utility\CreateReferenceNo::create('CIT');

        $user_refid     = $request['user_refid'];
        $store_refid    = $request['store_refid'];
        $price          = floatval($request['price']);
        $quantity       = floatval($request['quantity']);
        $total          = $price * $quantity;
        $add_ons_total  = floatval($request['add_ons_total']);
        $grand_total    = $total + $add_ons_total;
        $thesamestore   = Add::isTheSameStore($store_refid, $user_refid);

        if($thesamestore == false) {
            return [
                "success"   => false,
                "message"   => "Multi-store ordering is not applicable. Please make order from the same store."
            ];
        }
        else if($quantity <= 0) {
            return [
                "success"   => false,
                "message"   => "Please provide quantity."
            ];
        }
        else if($price <= 0) {
            return [
                "success"   => false,
                "message"   => "Please invalid price."
            ];
        }
        else {
            $added = DB::table("plugin_order_item")->insert([
                "reference_id"              => $reference_id,
                "product_refid"             => $request['product_refid'],
                "user_refid"                => $user_refid,
                "store_refid"               => $store_refid,
                "quantity"                  => $quantity,
                "price"                     => $price,
                "total"                     => $total,
                "variant_info"              => $request['variant_info'],
                "add_ons_array"             => $request['add_ons_array'],
                "add_ons_total"             => $add_ons_total,
                "grand_total"               => $grand_total
            ]);

            if($added) {

                $cart_item_count            = \App\Http\Controllers\plugin_order_item\CountCartItem::count($user_refid);

                return [
                    "success"               => true,
                    "reference_id"          => $reference_id,
                    "cart_item_count"       => $cart_item_count,
                    "store_refid"           => $store_refid,
                    "message"               => "Product successfully added to the cart"
                ];
            }
            else {
                return [
                    "success"               => false,
                    "reference_id"          => null,
                    "cart_item_count"       => 0,
                    "message"               => "Adding product to cart unsuccessful"
                ];
            }
        }
    }

    public static function isTheSameStore($store_refid, $user_refid) {
        $data = DB::table("plugin_order_item")
            ->select("store_refid")
            ->where([
                ["user_refid", $user_refid],
                ["status", 0]
            ])
            ->orderBy("dataid","DESC")
            ->limit(1)
            ->get();

            if(count($data) > 0) {
                $last_store = $data[0]->store_refid;
                if($last_store == $store_refid) {
                    return true;
                }
                else {
                    return false;
                }
            }
            else {
                return true;
            }
    }
}
