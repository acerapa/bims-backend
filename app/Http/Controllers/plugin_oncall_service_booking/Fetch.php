<?php

namespace App\Http\Controllers\plugin_oncall_service_booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * api/plugin_oncall_service_providers/fetchBooking
 * 
 */

class Fetch extends Controller
{
    public static function get(Request $request) {

        $user_refid     = $request['user_refid'];
        
        $data = DB::table("plugin_oncall_service_booking")
        ->where([
            ["user_refid", $user_refid]
        ])
        ->paginate(12)
        ->toArray();

        $data_list          = $data['data'];
        $temp               = [];

        foreach($data_list as $item) {
            $temp[] = [
                "header"            => [
                    "reference_id"          => $item->reference_id,
                    "convo_refid"           => $item->convo_refid,
                    "user_refid"            => $item->user_refid,
                    "provider_refid"        => $item->provider_refid,
                    "branch_refid"          => $item->branch_refid,
                    "city_code"             => $item->city_code,
                    "service_type"          => $item->service_type,
                    "service_type_text"     => \App\Http\Controllers\plugin_oncall_service_providers\Fetch::service_text('ELECN'),
                    "contact_person"        => $item->contact_person,
                    "contact_number"        => $item->contact_number,
                    "work_date"             => $item->work_date,
                    "work_time"             => $item->work_time,
                    "work_description"      => $item->work_description,
                    "address"               => $item->address,
                    "provider_fee"          => floatval($item->provider_fee),
                    "foxcity_fee"           => floatval($item->foxcity_fee),
                    "days"                  => $item->days,
                    "total"                 => floatval($item->total),
                    "created_at"            => $item->created_at,
                    "foxcity_fee_paid"      => $item->foxcity_fee_paid,
                    "foxcity_date_paid"     => $item->foxcity_date_paid,
                    "status"                => $item->status,
                    "status_text"           => Fetch::status_text($item->status)
                ]
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
            "hostlink"          => env("FTP_SERVER_HOSTLINK_1")
        ];
    }

    public static function status_text($status) {
        $status = intval($status);
        if($status == 1) {
            return "New";
        }
        else if($status == 2) {
            return "Cancelled";
        }
        else if($status == 3) {
            return "Refused";
        }
        else if($status == 4) {
            return "Accepted";
        }
        else if($status == 5) {
            return "Completed";
        }
        else {
            return $status;
        }
    }
}
