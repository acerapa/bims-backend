<?php

namespace App\Http\Controllers\plugin_store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_store/fetchStoreProfile/STR-05042023044205-QEN
 * 
 * \App\Http\Controllers\plugin_store\FetchStoreProfile::get($store_refid);
 * 
 */

class FetchStoreProfile extends Controller
{
    public static function get($store_refid) {
        return [
            "header"    => FetchStoreProfile::header($store_refid),
            "menu"      => null,
            "product"   => null,
            "branches"  => null
        ];
    }

    public static function header($store_refid) {
        $data = DB::table("plugin_store")
        ->where([
            ["reference_id", $store_refid]
        ])
        ->get();

        if(count($data) > 0) {
            $list = [];
            foreach($data as $column) {
                $list = [
                    "reference_id"          => $column->reference_id,
                    "name"                  => $column->name,
                    "description"           => $column->description,
                    "photo_refid_logo"      => json_decode($column->photo_refid_logo),
                    "photo_refid_cover"     => json_decode($column->photo_refid_cover),
                    "address"               => $column->address,
                    "geo_lat"               => floatval($column->geo_lat),
                    "geo_lng"               => floatval($column->geo_lng),
                    "review_score"          => floatval($column->review_score),
                    "followers"             => floatval($column->followers),
                    "open"                  => $column->open
                ];
            }
            return $list;
        }
        else {
            return null;
        }
    }
}
