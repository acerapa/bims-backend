<?php

namespace App\Http\Controllers\plugin_product_addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_product_addons/allByStore/store_refid
 */

class Fetch extends Controller
{
    public static function allByStore($store_refid) {
        
        $data = DB::table("plugin_product_addons")
        ->where("store_refid", $store_refid)
        ->select("reference_id","store_refid","name","price","photo_cover","available")
        ->orderBy("name","asc")
        ->get();

        if(count($data) > 0) {
            $list = [];
            foreach($data as $addon) {
                $list[] = [
                    "addon_refid"   => $addon->reference_id,
                    "store_refid"   => $addon->store_refid,
                    "name"          => $addon->name,
                    "price"         => floatval($addon->price),
                    "photo_cover"   => json_decode($addon->photo_cover),
                    "available"     => $addon->available,
                ];
            }
            return $list;
        }
        else {
            return [];
        }
    }
}
