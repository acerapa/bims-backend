<?php

namespace App\Http\Controllers\plugin_vehicle_rent_booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * api/plugin_vehicle_rent_booking/cancelBooking?booking_refid=VRB-07032023114741-3KJ&branch_refid=xxx&convo_refid=&user_refid=
 * 
 */

class Cancel extends Controller
{
    public static function cancel(Request $request) {

        $booking_refid  = $request['booking_refid'];
        $convo_refid    = $request['convo_refid'];
        $user_refid     = $request['user_refid'];

        $cancelled = DB::table("plugin_vehicle_rent_booking")
        ->where([
            ["reference_id", $booking_refid],
            ["status", 1]
        ])
        ->update([
            "status"        => 2,
            "cancel_date"   => date("Y-m-d h:i:s")
        ]);

        if($cancelled) {

            /** Send message to convo */

            $branch_info    = \App\Http\Controllers\plugin_branch\Fetch::get(1, $request['branch_refid']);
            $branch_admin   = $branch_info['chat_admin'];

            /** Notify admin */
            if(count($branch_admin) > 0) {
                $message        = "Vehicle rental booking with Ref. No.:" . $booking_refid . " was cancelled by customer";
                $group          = "VHCL_RENT_CANCELLED";
                $payload        = [
                    "booking_refid"   => $booking_refid,
                    "convo_refid"     => $convo_refid,
                    "user_refid"      => $user_refid
                ];
                foreach($branch_admin as $admin) {
                    \App\Http\Controllers\plugin_notification\Send::send($admin['user_refid'], $message, $group, $payload);
                }
            }

            return [
                "success"   => true,
                "message"   => "Cancelled successfully"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Cancel request refused by the system, contact help support"
            ];
        }
    }
}
