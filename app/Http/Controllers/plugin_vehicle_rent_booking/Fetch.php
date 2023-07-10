<?php

namespace App\Http\Controllers\plugin_vehicle_rent_booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 
 */

class Fetch extends Controller
{
    public static function userBooking(Request $request) {
        $data = DB::table("plugin_vehicle_rent_booking")
        ->where("user_refid", $request['user_refid'])
        ->orderBy("dataid","desc")
        ->paginate(12)
        ->toArray();

        $data_list          = $data['data'];
        $temp               = [];

        foreach($data_list as $item) {
            $temp[] = [
                "header"            => [
                    "booking_refid"         => $item->reference_id,
                    "branch_refid"          => $item->branch_refid,
                    "vehicle_refid"         => $item->vehicle_refid,
                    "user_refid"            => $item->user_refid,
                    "rent_from"             => $item->rent_from,
                    "rent_to"               => $item->rent_to,
                    "price_base"            => floatval($item->price_base),
                    "price_charged"         => floatval($item->price_charged),
                    "service_fee"           => floatval($item->service_fee),
                    "service_fee_amount"    => floatval($item->service_fee_amount),
                    "days"                  => $item->days,
                    "driver"                => $item->driver,
                    "driver_text"           => \App\Http\Controllers\plugin_vehicle_rent_vehicles\Fetch::driver_text($item->driver),
                    "driver_fee"            => floatval($item->driver_fee),
                    "message"               => $item->message,
                    "convo_refid"           => $item->convo_refid,
                    "total"                 => floatval($item->total),
                    "created_at"            => $item->created_at,
                    "foxcity_fee_paid"      => $item->foxcity_fee_paid,
                    "foxcity_date_paid"     => $item->foxcity_date_paid,
                    "status"                => $item->status,
                    "status_text"           => Fetch::status_text($item->status)
                ],
                "vehicle_info"              => \App\Http\Controllers\plugin_vehicle_rent_vehicles\Fetch::vehicle_info($item->vehicle_refid),
            ];
        }

        return [
            "current_page"      => $data['current_page'],
            "last_page"         => $data['last_page'],
            "from"              => $data['from'],
            "to"                => $data['to'],
            "per_page"          => $data['per_page'],
            "total"             => $data['total'],
            "data"              => $temp,
        ];
    }

    public static function status_text($status) {
        $status = intval($status);
        if($status == 1) {
            return "New";
        }
        else if($status == 2) {
            return "Cancelled by customer";
        }
        else if($status == 3) {
            return "Accepted";
        }
        else if($status == 4) {
            return "Done";
        }
        else {
            return $status;
        }
    }
}
