<?php

namespace App\Http\Controllers\plugin_product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_product/productProfile?json_file=0&product_refid=PRD-05102023024701-NKA
 * \App\Http\Controllers\plugin_product\ProductProfile::ProductProfile::photos($product_refid);
 * \App\Http\Controllers\plugin_product\ProductProfile::ProductProfile::pricing($product_refid);
 * \App\Http\Controllers\plugin_product\ProductProfile::ProductProfile::stock($product_refid);
 * \App\Http\Controllers\plugin_product\ProductProfile::ProductProfile::sold($product_refid);
 */

class ProductProfile extends Controller
{
    public static function get(Request $request) {

        $product_refid  = $request['product_refid'];
        $json_file      = $request['json_file'];

        return [
            "header"                => ProductProfile::header($json_file, $product_refid),
            "photos"                => ProductProfile::photos($json_file, $product_refid),
            "pricing"               => ProductProfile::pricing($json_file, $product_refid),
            "stock"                 => ProductProfile::stock($json_file, $product_refid),
            "sold"                  => ProductProfile::sold($json_file, $product_refid),
            "reviews_page_1"        => ProductProfile::reviews($json_file, $product_refid),
            "hostlink"              => env("FTP_SERVER_HOSTLINK_1")
        ];
    }

    public static function header($json_file, $product_refid) {

        $file_path      = "plugin_product/" . $product_refid .".json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if(($json_exist) && ($json_file == '1')) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {

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

            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data);
            return $data;
        }
    }

    public static function photos($json_file, $product_refid) {

        $file_path      = "plugin_photo/" . $product_refid .".json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if(($json_exist) && ($json_file == '1')) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {

            $data = DB::table("plugin_photo")
            ->select("dataid","reference_id","filepath","filename","description","size","extension","server_no","status")
            ->where("tagged", $product_refid)
            ->get();

            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data);
            return $data;

        }
    }

    public static function pricing($json_file, $product_refid) {

        $file_path      = "plugin_product_pricing/" . $product_refid .".json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if(($json_exist) && ($json_file == '1')) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {

            $data = DB::table("plugin_product_pricing")
            ->select("price","price_less","price_variants","price_type","addons")
            ->where("product_refid", $product_refid)
            ->get();
            if(count($data) > 0) {
            
                $price_variants = null;
                if($data[0]->price_variants !== null) {
                    $price_variants = json_decode($data[0]->price_variants);
                }

                $addons_list            = [];
                if($data[0]->addons !== null) {
                    $addons                 = json_decode($data[0]->addons);
                    foreach($addons as $addon) {
                        $addons_data        = DB::table("plugin_product_addons")->where("reference_id", $addon)->get();
                        if(count($addons_data) > 0) {
                            $addons_list[]    = [
                                "addon_refid"       => $addons_data[0]->reference_id,
                                "store_refid"       => $addons_data[0]->store_refid,
                                "name"              => $addons_data[0]->name,
                                "price"             => floatval($addons_data[0]->price),
                                "photo_cover"       => json_decode($addons_data[0]->photo_cover),
                                "available"         => $addons_data[0]->available,
                            ];
                        }
                    }
                }

                $data = [
                    "price"             => floatval($data[0]->price),
                    "price_less"        => floatval($data[0]->price_less),
                    "price_variants"    => $price_variants,
                    "price_type"        => $data[0]->price_type,
                    "addons"            => $addons_list
                ];
            }
            else {
                $data = [];
            }

            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data);
            return $data;
        }
    }

    public static function stock($json_file, $product_refid){

        $file_path      = "plugin_product_stock/" . $product_refid .".json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if(($json_exist) && ($json_file == '1')) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {
            $source = DB::table("plugin_product_stock")
            ->select("inv_type","quantity_inp","quantity_old","quantity_new","created_at")
            ->where("product_refid", $product_refid)
            ->get();
            if(count($source) > 0) {
                $data = [
                    "inv_type"      => $source[0]->inv_type,
                    "quantity_inp"  => floatval($source[0]->quantity_inp),
                    "quantity_old"  => floatval($source[0]->quantity_old),
                    "quantity_new"  => floatval($source[0]->quantity_new),
                    "created_at"    => $source[0]->created_at,
                ];
            }
            else {
                $data = [];
            }

            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data);
            return $data;
        }
    }

    public static function reviews($json_file, $product_refid) {
        return \App\Http\Controllers\plugin_product_review\Fetch::method(['json_file' => $json_file, 'product_refid' => $product_refid, 'order_by' => 'most_recent', 'page'=>1]);
    }

    public static function sold($json_file, $product_refid) {
        return rand(0, 1000);
    }
}
