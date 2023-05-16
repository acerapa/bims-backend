<?php

namespace App\Http\Controllers\plugin_product_pricing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 
 * plugin_product_pricing/setPriceVariant?product_refid=PRD-05102023024701-NKA&variants=[{}]
 * \App\Http\Controllers\plugin_product_pricing\SetPriceVariant::method([
 *      "product_refid" => $product_refid,
 *      "variants"      => [Object]
 * ]);
 */

class SetPriceVariant extends Controller
{
    public static function set(Request $request) {
        return SetPriceVariant::method($request);
    }

    public static function method($request) {
        
        $data = DB::table("plugin_product_pricing")
        ->where("product_refid", $request['product_refid'])
        ->update([
            "price_variants"    => $request['variants'],
            "price"             => 0,
            "price_less"        => 0,
            "price_type"        => 'VP'
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
