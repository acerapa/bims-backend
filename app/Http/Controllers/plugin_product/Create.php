<?php

namespace App\Http\Controllers\plugin_product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 
 * api/plugin_product/create_init?store_refid=&created_by=\
 * -Create initial data
 * 
 * api/plugin_product/create_details?product_refid=&store_SKU=&store_menu_refid=&name=&description=&category_global_refid=
 * - Complete the initial data
 * 
 */

class Create extends Controller
{
    public static function init(Request $request) {
        $reference_id = \App\Http\Controllers\plugin_utility\CreateReferenceNo::create('PRD');
        $create = DB::table("plugin_product")->insert([
            "reference_id"              => $reference_id,
            "store_refid"               => $request['store_refid'],
            "created_at"                => date("Y-m-d h:i:s"),
            "created_by"                => $request['created_by'],
            "status"                    => 0
        ]);

        if($create) {
            return [
                "success"           => true,
                "product_refid"     => $reference_id,
                "message"           => "Successfully created"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Something went wrong"
            ];
        }
    }
    
    public static function details(Request $request) {

        $create = DB::table("plugin_product")
        ->where("reference_id", $request['product_refid'])
        ->update([
            "store_refid"               => $request['store_refid'],
            "store_SKU"                 => $request['store_SKU'],
            "store_menu_refid"          => $request['store_menu_refid'],
            "name"                      => $request['name'],
            "description"               => $request['description'],
            "category_global_refid"     => $request['category_global_refid'],
            "subcategory_global_refid"  => $request['subcategory_global_refid'],
            "created_by"                => $request['created_by'],
            "status"                    => 0
        ]);

        if($create) {
            return [
                "success"           => true,
                "reference_id"      => $reference_id,
                "message"           => "Successfully created"
            ];
        }
        else {
            return [
                "success"           => false,
                "message"           => "Unable to save details"
            ];
        }
    }

}
