<?php

namespace App\Http\Controllers\plugin_product_pricing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_product_pricing/setPriceSingle?product_refid=PRD-05102023024701-NKA&price=99
 * \App\Http\Controllers\plugin_product_pricing\SetPriceSingle::method([
 *      "product_refid" => $product_refid,
 *      "price"         => 00
 * ]);
 */

class SetPriceSingle extends Controller
{
    public static function set(Request $request) {
        return SetPriceSingle::method($request);
    }

    public static function method($request) {
        $data = DB::table("plugin_product_pricing")
        ->where("product_refid", $request['product_refid'])
        ->update([
            "price"             => $request['price'],
            "price_variants"    => null,
            "price_type"        => 'SP'
        ]);

        if($data) {
            return [
                "success"   => true,
                "message"   => "Price successfully set"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Request unsuccessful"
            ];
        }
    }
}
