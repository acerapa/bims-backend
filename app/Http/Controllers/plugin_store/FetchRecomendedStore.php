<?php

namespace App\Http\Controllers\plugin_store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * \App\Http\Controllers\plugin_store\FetchRecomendedStore::allOpen();
 * \App\Http\Controllers\plugin_store\FetchRecomendedStore::reviewScore(8);
 */

class FetchRecomendedStore extends Controller
{

    public static function allOpen() {
        $data = DB::table("plugin_store")
        ->where([
            ["open", 1],
        ])
        ->get();

        if(count($data) > 0) {
            $list = [];
            foreach($data as $store) {
                $list[] = [
                    "store_refid"           => $store->reference_id,
                    "name"                  => $store->name,
                    "description"           => $store->description,
                    "photo_refid_logo"      => json_decode($store->photo_refid_logo),
                    "photo_refid_cover"     => json_decode($store->photo_refid_cover),
                    "address"               => $store->address,
                    "province_code"         => $store->province_code,
                    "city_code"             => $store->city_code,
                    "brgy_code"             => $store->brgy_code,
                    "geo_lat"               => floatval($store->geo_lat),
                    "geo_lng"               => floatval($store->geo_lng),
                    "review_score"          => floatval($store->review_score),
                    "open"                  => $store->open
                ];
            }
            return $list;
        }
        else {
            return [];
        }
    }

    public static function reviewScore($limit) {
        $data = DB::table("plugin_store")
        ->where([
            ["open", 1],
            ["review_score",">",0]
        ])
        ->limit($limit)
        ->get();

        if(count($data) > 0) {
            $list = [];
            foreach($data as $store) {
                $list[] = [
                    "store_refid"           => $store->reference_id,
                    "name"                  => $store->name,
                    "description"           => $store->description,
                    "photo_refid_logo"      => json_decode($store->photo_refid_logo),
                    "photo_refid_cover"     => json_decode($store->photo_refid_cover),
                    "address"               => $store->address,
                    "province_code"         => $store->province_code,
                    "city_code"             => $store->city_code,
                    "brgy_code"             => $store->brgy_code,
                    "geo_lat"               => floatval($store->geo_lat),
                    "geo_lng"               => floatval($store->geo_lng),
                    "review_score"          => floatval($store->review_score),
                    "open"                  => $store->open
                ];
            }
            return $list;
        }
        else {
            return [];
        }
    }
}
