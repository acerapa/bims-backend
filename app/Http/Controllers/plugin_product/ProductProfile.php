<?php

namespace App\Http\Controllers\plugin_product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 *  plugin_product/productProfile?json_memory=0&product_refid=PRD-05102023024701-NKA
 */

class ProductProfile extends Controller
{
    public static function get(Request $request) {

        $product_refid  = $request['product_refid'];
        $json_memory    = $request['json_memory'];

        $file_path      = "product_profile/" . $product_refid .".json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if(($json_exist) && ($json_memory == '1')) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {
            
            $data = [
                "header"    => ProductProfile::header($product_refid),
                "photos"    => ProductProfile::photos($product_refid),
                "pricing"   => ProductProfile::pricing($product_refid),
                "stock"     => ProductProfile::stock($product_refid),
                "hostlink"  => env("FTP_SERVER_HOSTLINK_1")
            ];

            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data);
            return $data;
        }
    }

    public static function header($product_refid) {
        $data = DB::table("plugin_product")
        ->select("reference_id as product_refid","store_refid","store_SKU","store_menu_refid","name","description","category_global_refid","subcategory_global_refid","sharable","available","status")
        ->where("reference_id", $product_refid)
        ->get();
        if(count($data) > 0) {
            return $data[0];
        }
        else {
            return null;
        }
    }

    public static function photos($product_refid) {
        return DB::table("plugin_photo")
        ->select("dataid","reference_id","filepath","filename","description","size","extension","server_no","status")
        ->where("tagged", $product_refid)
        ->get();
    }

    public static function pricing($product_refid) {
        $data = DB::table("plugin_product_pricing")
        ->select("price","price_variants","price_type","addons")
        ->where("product_refid", $product_refid)
        ->get();
        if(count($data) > 0) {
           
            $price_variants = null;
            if($data[0]->price_variants !== null) {
                $price_variants = json_decode($data[0]->price_variants);
            }

            $addons = null;
            if($data[0]->addons !== null) {
                $addons = json_decode($data[0]->addons);
            }

            return [
                "price"             => floatval($data[0]->price),
                "price_variants"    => $price_variants,
                "price_type"        => $data[0]->price_type,
                "addons"            => $addons
            ];
        }
        else {
            return null;
        }
    }

    public static function stock($product_refid){
        $data = DB::table("plugin_product_stock")
        ->select("inv_type","quantity_inp","quantity_old","quantity_new","created_at")
        ->where("product_refid", $product_refid)
        ->get();
        if(count($data) > 0) {
            return [
                "inv_type"      => $data[0]->inv_type,
                "quantity_inp"  => floatval($data[0]->quantity_inp),
                "quantity_old"  => floatval($data[0]->quantity_old),
                "quantity_new"  => floatval($data[0]->quantity_new),
                "created_at"    => $data[0]->created_at,
            ];
        }
        else {
            return null;
        }
    }
}
