<?php

namespace Project\FoxcityFood;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * foxcity_food/mycart/1/USR-033121093459-TCS
 * 
 * 
 * TODO
 * http://127.0.0.1:8000/foxcity_food/mycart/1/USR-033121093459-TCS/SFD-05082021064237-TCL
 */

class MyCart extends Controller
{
    public static function get($json_file, $user_refid, $store_refid) {

        $store              = \App\Http\Controllers\plugin_store\FetchStoreHeader::get($json_file, $store_refid);
        $user_address       = \App\Http\Controllers\plugin_user_address_local\Fetch::get($json_file, $user_refid);
        $branch             = \App\Http\Controllers\plugin_branch\Fetch::get($json_file, $store['branch_refid']);
        $distance           = MyCart::matrix($store['geo_lat'], $store['geo_lng'], floatval($user_address['info_json']['lat']), floatval($user_address['info_json']['lng']));

        $dist_first_km      = $branch['service_food_first_km'];
        $dist_next_km       = $branch['service_food_next_km'];
        $matx_distance      = $distance['data']['distance_km_value'];
        $delivery_fee       = 0;

        if($matx_distance <= 1) {
            $delivery_fee   = $dist_first_km;
        }
        else {
            $delivery_fee   = (($matx_distance - 1) * $dist_next_km) + $dist_first_km;
        }

        return [
            "user"          => \App\Http\Controllers\plugin_user\GetProfile::header($json_file, $user_refid),
            "user_address"  => $user_address,
            "store"         => $store,
            "branch"        => $branch, 
            "store_staff"   => [],
            "cart_items"    => \App\Http\Controllers\plugin_order_item\FetchItems::get($user_refid, $store_refid, 0),
            "distance"      => $distance,
            "summary"       => [
                "dist_first_km"     => $dist_first_km,
                "dist_next_km"      => $dist_next_km,
                "matx_distance"     => $matx_distance,
                "delivery_fee"      => round($delivery_fee, 2, PHP_ROUND_HALF_UP )
            ]
        ];
    }

    public static function matrix($store_lat, $store_lng, $lat, $lng) {

        if(is_float($store_lat) && is_float($store_lng) && is_float($lat) && is_float($lng)) {

            $origins            = $store_lat . ',' . $store_lng;
            $destinations       = $lat . ',' . $lng;
            $response           = \App\Http\Controllers\plugin_gps\MatrixDistance::getDistance($origins, $destinations);
            $meter_value        = $response['rows'][0]['elements'][0]['distance']['value'];
            $km_value           = $meter_value / 1000;

            return [
                "success"   => true,
                "data"      => [
                    "destination_addresses"         => $response['destination_addresses'],
                    "origin_addresses"              => $response['origin_addresses'],
                    "distance_km_text"              => $response['rows'][0]['elements'][0]['distance']['text'],
                    "distance_m_value"              => $meter_value,
                    "distance_km_value"             => $km_value,
                    "duration_text"                 => $response['rows'][0]['elements'][0]['duration']['text'],
                    "duration_value"                => $response['rows'][0]['elements'][0]['duration']['value'],
                    "origins"                       => $origins,
                    "destinations"                  => $destinations
                ]
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Invalid geological inputs"
            ];
        }

        
    }
}