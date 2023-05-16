<?php

namespace App\Http\Controllers\plugin_product_addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_product_addons/allByStore/store_refid
 * \App\Http\Controllers\plugin_product_addons\Fetch::allByStore(1, $store_refid);
 */

class Fetch extends Controller
{
    public static function allByStore($memory_json, $store_refid) {

        $file_path      = "plugin_product_addons/".$store_refid.".json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if(($json_exist) && ($memory_json == 1)) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {
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
            }
            else {
                $list = [];
            }

            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $list);
            return $data;
        }
    }
}
