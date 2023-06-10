<?php

namespace App\Http\Controllers\plugin_store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * \App\Http\Controllers\plugin_store\FetchRecomendedResto::method($store_type, $city_code);
 */

class FetchRecomendedResto extends Controller
{
    public static function get(Request $request) {
        return FetchRecomendedResto::method($request['store_type'], $request['city_code']);
    }

    public static function method($store_type, $city_code) {
        $source = DB::table("plugin_store")
        ->where([
            ["store_type", $store_type],
            ["open", 1]
        ])
        ->paginate(12)->toArray();

        $data = $source['data'];

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
                    "loc_region"            => intval($store->loc_region),
                    "loc_province"          => intval($store->loc_province),
                    "loc_city"              => intval($store->loc_city),
                    "loc_brgy"              => intval($store->loc_brgy),
                    "order_cost_service_fee"=> floatval($store->order_cost_service_fee),
                    "last_modefied"         => $store->last_modefied,
                    "review_score"          => floatval($store->review_score),
                    "followers"             => [
                        "number"                => $store->followers,
                        "string"                => \App\Http\Controllers\plugin_utility\NumberAbbreviation::shorten($store->followers)
                    ],
                    "open"                  => $store->open
                ];
            }
            
            return [
                "current_page"      => $source['current_page'],
                "last_page"         => $source['last_page'],
                "from"              => $source['from'],
                "to"                => $source['to'],
                "per_page"          => $source['per_page'],
                "total"             => $source['total'],
                "data"              => $list,
                "hostlink"          => env("FTP_SERVER_HOSTLINK_1")
            ];
        }
        else {
            return [];
        }
    }
}
