<?php

namespace App\Http\Controllers\plugin_product_inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * App\Http\Controllers\plugin_product_inventory\Create::create($product_refid, $inv_type, $qty_inp, $qty_old, $created_by);
 */

class Create extends Controller
{
    public static function create($product_refid, $inv_type, $qty_inp, $qty_old, $created_by) {

        $qty_inp = floatval($qty_inp);
        $qty_old = floatval($qty_old);

        if($inv_type == 'QI') {
            $qty_new = $qty_old + $qty_inp;
        }
        else if($inv_type == 'QO') {
            $qty_new = $qty_old - $qty_inp;
        }
        else {
            $qty_new = $qty_old;
        }

        return DB::table("plugin_product_inventory")
        ->insert([
            "product_refid" => $product_refid,
            "inv_type"      => $inv_type,
            "quantity_inp"  => $qty_inp,
            "quantity_old"  => $qty_old,
            "quantity_new"  => $qty_new,
            "created_by"    => $created_by
        ]);
    }
}
