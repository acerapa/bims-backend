<?php

namespace App\Http\Controllers\plugin_store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_store/fetchstoreheader/1/STR-05042023044205-QEN
 * \App\Http\Controllers\plugin_store\FetchStoreHeader::get($json_file, $store_refid);
 * 
 */

class FetchStoreHeader extends Controller
{
    public static function get($json_file, $store_refid) {

        $file_path      = "plugin_store/". $store_refid .".json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if(($json_exist) && ($json_file == '1')) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {

            $data = DB::table("plugin_store")->where("reference_id", $store_refid)->get();

            if(count($data) > 0) {
                $list = [
                    "reference_id"              => $data[0]->reference_id,
                    "name"                      => $data[0]->name,
                    "store_type"                => $data[0]->store_type,
                    "description"               => $data[0]->description,
                    "photo_refid_logo"          => json_decode($data[0]->photo_refid_logo),
                    "photo_refid_cover"         => json_decode($data[0]->photo_refid_cover),
                    "address"                   => $data[0]->address,
                    "geo_lat"                   => floatval($data[0]->geo_lat),
                    "geo_lng"                   => floatval($data[0]->geo_lng),
                    "order_cost_service_fee"    => floatval($data[0]->order_cost_service_fee),
                    "review_score"              => floatval($data[0]->review_score),
                    "followers"                 => floatval($data[0]->followers),
                    "open"                      => $data[0]->open
                ];
            }
            else {
                $list = [];
            }

            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $list);
            return $list;
        }
    }
}
