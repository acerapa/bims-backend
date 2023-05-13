<?php

namespace App\Http\Controllers\plugin_product_pricing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * \App\Http\Controllers\plugin_product_pricing\Create::init($product_refid, $created_by);
 * 
 */

class Create extends Controller
{
    public static function init($product_refid, $created_by) {
        $count = Create::isExist($product_refid);
        if($count == 0) {
            return DB::table("plugin_product_pricing")->insert([
                "product_refid" => $product_refid,
                "created_by" => $created_by
            ]);
        }
    }

    public static function isExist($product_refid) {
        return DB::table("plugin_product_pricing")->where("product_refid", $product_refid)->count();
    }

}
