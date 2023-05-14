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
 * api/plugin_product/create_details?product_refid=&store_SKU=&store_menu_refid=&name=&description=&category_global_refid=&subcategory_global_refid=&sharable=&available=&stock=&created_by=
 * - Complete the initial data
 * 
 */

class Create extends Controller
{
    public static function init(Request $request) {

        $reference_id   = \App\Http\Controllers\plugin_utility\CreateReferenceNo::create('PRD');
        $getDraft       = Create::getDraft($request['store_refid']);

        if(count($getDraft) == 0) {
            $create = DB::table("plugin_product")->insert([
                "reference_id"              => $reference_id,
                "store_refid"               => $request['store_refid'],
                "created_at"                => date("Y-m-d h:i:s"),
                "created_by"                => $request['created_by'],
                "status"                    => 0
            ]);
    
            if($create) {

                $stock = \App\Http\Controllers\plugin_product_stock\Create::initialStock($reference_id, 0, $request['created_by']);
                $price = \App\Http\Controllers\plugin_product_pricing\Create::init($reference_id, $request['created_by']);

                return [
                    "success"           => true,
                    "draft"             => false,
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
        else {
            return [
                "success"           => true,
                "draft"             => true,
                "product_refid"     => $getDraft[0]->reference_id,
                "message"           => "From draft record"
            ];
        }
    }

    public static function getDraft($store_refid) {
        return DB::table("plugin_product")
        ->where([
            ["store_refid", $store_refid],
            ["status", 0]
        ])
        ->get();
    }
    
    public static function details(Request $request) {
        
        $create = DB::table("plugin_product")
        ->where("reference_id", $request['product_refid'])
        ->update([
            "store_SKU"                 => $request['store_SKU'],
            "store_menu_refid"          => $request['store_menu_refid'],
            "name"                      => $request['name'],
            "description"               => $request['description'],
            "category_global_refid"     => $request['category_global_refid'],
            "subcategory_global_refid"  => $request['subcategory_global_refid'],
            "sharable"                  => $request['sharable'],
            "available"                 => $request['available']
        ]);

        if($create) {

            $stock      = \App\Http\Controllers\plugin_product_stock\Create::create($request['product_refid'], 'SI', $request['stock'], 0, $request['created_by']);
            $price      = \App\Http\Controllers\plugin_product_pricing\Create::init($request['product_refid'], $request['created_by']);
            
            return [
                "success"           => true,
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
