<?php

namespace Project\Foxcity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * foxcity/mycartProfile/1/USR-033121093459-TCS/STR-05042023044205-QEN
 * \Project\Foxcity\MyCartProfile::get($json_file, $user_refid);
 */

class MyCartProfile extends Controller
{
    public static function local($json_file, $user_refid, $store_refid, $lat, $lng) {

        $store_header                   = \App\Http\Controllers\plugin_store\FetchStoreHeader::get($json_file, $store_refid);
        $store_ship_del_method          = \App\Http\Controllers\plugin_store_ship_del_method\Fetch::get($json_file, $store_refid);
        $customer_header                = \App\Http\Controllers\plugin_user\GetProfile::header($json_file, $user_refid);
        $customer_address               = \App\Http\Controllers\plugin_user_address_local\Fetch::get($json_file, $user_refid);
        $customer_distance_matrix       = MyCartProfile::matrix($store_header['geo_lat'], $store_header['geo_lng'], floatval($lat), floatval($lng));
        $cart_items                     = \App\Http\Controllers\plugin_order_item\FetchItems::get($user_refid, $store_refid, 0);
        $summary                        = MyCartProfile::summary($store_header['geo_lat'], $store_header['geo_lng'], $customer_address['info_json']['lat'], $customer_address['info_json']['lng']);

        return [
            "store_header"              => $store_header,
            "store_ship_del_method"     => $store_ship_del_method,
            "customer_header"           => $customer_header,
            "customer_address"          => $customer_address,
            "customer_distance_matrix"  => $customer_distance_matrix,
            "cart_items"                => $cart_items,
            "voucher_claimed"           => [],
            "voucher_store"             => [],
            "voucher_foxcity"           => [],
            "customer_address_matrix"   => $summary,
            "hostlink"                  => env("FTP_SERVER_HOSTLINK_1")
        ];
    }

    public static function national($json_file, $user_refid, $store_refid, $lat, $lng) {

    }

    public static function get($json_file, $user_refid, $store_refid, $lat, $lng) {

        $store_header                   = \App\Http\Controllers\plugin_store\FetchStoreHeader::get($json_file, $store_refid);

        return [
            "store"                     => [
                "header"                => $store_header,
            ],
            "store_ship_del_method"     => \App\Http\Controllers\plugin_store_ship_del_method\Fetch::get($json_file, $store_refid),
            "customer"                  => [
                "header"                => \App\Http\Controllers\plugin_user\GetProfile::header($json_file, $user_refid),
                "address_local"         => \App\Http\Controllers\plugin_user_address_local\Fetch::get($json_file, $user_refid),
                "address_national"      => [],
            ],
            "cart_items"                => \App\Http\Controllers\plugin_order_item\FetchItems::get($user_refid, $store_refid, 0),
            "voucher"                   => [
                "claimed_vouchers"      => [],
                "store_vouchers"        => [],
                "foxcity_vouchers"      => []
            ],
            "distance_user_position"    => MyCartProfile::matrix($store_header['geo_lat'], $store_header['geo_lng'], floatval($lat), floatval($lng)),
            "shipping_or_delivery"      => [
                "in_house_rider"        => [],
                "foxcity_rider"         => [],
                "third_party_lbc"       => [],
                "third_party_jnt"       => []           
            ],
            "hostlink"                  => env("FTP_SERVER_HOSTLINK_1")
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

    public static function summary($store_lat, $store_lng, $lat, $lng) {

        if(is_float($store_lat) && is_float($store_lng) && is_float($lat) && is_float($lng)) {

            $origins            = $store_lat . ',' . $store_lng;
            $destinations       = $lat . ',' . $lng;
            $response           = \App\Http\Controllers\plugin_gps\MatrixDistance::getDistance($origins, $destinations);
            $meter_value        = $response['rows'][0]['elements'][0]['distance']['value'];
            $km_value           = $meter_value / 1000;

            return [
                "success"   => true,
                "message"   => "Actual distance from user's device to seller",
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