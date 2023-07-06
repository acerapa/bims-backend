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
                "header"            => $item,
                "service_text"      => \App\Http\Controllers\plugin_oncall_service_providers\Fetch::service_text('ELECN'),
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
}
