<?php

namespace App\Http\Controllers\plugin_vehicle_rent_vehicles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_vehicle_rent_vehicles/book?ok=1
 * 
 */

class Booking extends Controller
{
    public static function book(Request $request) {
        $posted = DB::table("plugin_vehicle_rent_booking")
        ->insert([
            "reference_id"          => \App\Http\Controllers\plugin_utility\CreateReferenceNo::create('plugin_vehicle_rent_booking'),
            "vehicle_refid"         => $request['vehicle_refid'],
            "user_refid"            => $request['user_refid'],
            "rent_from"             => $request['rent_from'],
            "rent_to"               => $request['rent_to'],
            "price_base"            => $request['price_base'],
            "price_charged"         => $request['price_charged'],
            "service_fee"           => $request['service_fee'],
            "service_fee_amount"    => $request['service_fee_amount'],
            "days"                  => $request['days'],
            "driver"                => $request['driver'],
            "driver_fee"            => $request['driver_fee'],
            "message"               => $request['message'],
            "convo_refid"           => \App\Http\Controllers\plugin_utility\CreateReferenceNo::create('CNV'),
            "total"                 => $request['total'],
            "created_at"            => date("Y-m-d h:i:s"),
            "status"                => 1
        ]);

        if($posted) {

            /**
             * TOD DO:
             * Notify branch admin about the booking
             */

            return [
                "success" => true,
                "message" => "Booking successfully posted, Foxcity agent will call for further details."
            ];
        }
        else {
            return [
                "success" => false,
                "message" => "Something went wrong, please try again later"
            ];
        }
    }
}
