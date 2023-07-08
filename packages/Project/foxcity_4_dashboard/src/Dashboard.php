<?php

namespace Project\Foxcity4Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * foxcity_4_dashboard/init?branch_refid=BRC-06122023113052-DPS
 */

class Dashboard extends Controller
{
    public static function init(Request $request) {
        return [
            "branch_info"                           => [],
            "counter" => [
                "service_food_new"                  => 0,
                "service_pabili_new"                => 0,
                "service_pasakay_new"               => 0,
                "service_send_pickup_new"           => 0,
                "service_oncall_service_new"        => Dashboard::service_new_transaction("plugin_oncall_service_booking", $request['branch_refid'], 1),
                "service_vehicle_rental_new"        => Dashboard::service_new_transaction("plugin_vehicle_rent_booking", $request['branch_refid'], 1),
                "users_total"                       => 0,
            ],
            "transactions" => [
                "service_food"                      => Dashboard::service_food($request),
                "service_pabili"                    => Dashboard::service_pabili($request),
                "service_pasakay_new"               => [],
                "service_send_pickup"               => Dashboard::service_send_pickup($request),
                "service_oncall_service"            => Dashboard::service_oncall_service($request),
                "service_vehicle_rental"            => Dashboard::service_vehicle_rental($request)
            ],
            "conversations"                         => []
        ];
    }

    public static function service_new_transaction($table, $branch_refid, $status) {
        return DB::table($table)
        ->where([
            ["branch_refid", $branch_refid],
            ["status", $status]
        ])
        ->count();
    }

    public static function service_food($request) {
        return [];
    }

    public static function service_pabili($request) {
        return [];
    }

    public static function service_send_pickup($request) {
        return [];
    }

    public static function service_oncall_service($request) {
        return DB::table("plugin_oncall_service_booking")
        ->where("branch_refid", $request['branch_refid'])
        ->orderBy("dataid","desc")
        ->limit(3)
        ->get();
    }

    public static function service_vehicle_rental($request) {
        return DB::table("plugin_vehicle_rent_booking")
        ->where("branch_refid", $request['branch_refid'])
        ->orderBy("dataid","desc")
        ->limit(3)
        ->get();
    }
}