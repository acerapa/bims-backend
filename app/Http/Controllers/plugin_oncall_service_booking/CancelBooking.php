<?php

namespace App\Http\Controllers\plugin_oncall_service_booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_oncall_service_providers/cancelBooking?booking_refid=OSB-07052023091231-F9A&branch_refid=branch_refid
 */

class CancelBooking extends Controller
{
    public static function cancel(Request $request) {

        $booking_refid  = $request['booking_refid'];
        $branch_refid   = $request['branch_refid'];
        $booking_info   = \App\Http\Controllers\plugin_query\GetRowBasic::get("plugin_oncall_service_booking", "all", "reference_id", $booking_refid);
        $branch_info    = \App\Http\Controllers\plugin_branch\Fetch::get(1, $branch_refid);

        if($branch_info['open'] == 0) {
            return [
                "success"   => false,
                "message"   => "The foxcity in your location is closed"
            ];
        }
        else if(count($booking_info) == 0) {
            return [
                "success"   => false,
                "message"   => "Booking not found"
            ];
        }
        else {
            $status         = intval($booking_info[0]->status);
            if($status == 1) {
                $cancelled = DB::table("plugin_oncall_service_booking")
                ->where([
                    ["reference_id", $booking_refid],
                    ["status", "1"]
                ])
                ->update([
                    "status" => 2
                ]);

                if($cancelled) {

                    /**Send message to convo that it was cancelled*/
                    /**TODO: Add code here */

                     /** Notify admin about the cancellation */
                    $branch_admin   = $branch_info['chat_admin'];
                    if(count($branch_admin) > 0) {
                        $message        = "Booking " . $booking_refid . " was cancelled";
                        $group          = "ONCALL_SERV_CANCELLED";
                        $payload        = [
                            "booking_refid"     => $booking_refid,
                            "user_refid"        => $booking_info[0]->user_refid
                        ];
                        foreach($branch_admin as $admin) {
                            \App\Http\Controllers\plugin_notification\Send::send($admin['user_refid'], $message, $group, $payload);
                        }
                    }
                    
                    return [
                        "success"   => true,
                        "message"   => "Booking was cancelled successfully"
                    ];
                }
                else {
                    return [
                        "success"   => false,
                        "message"   => "System refused cancel request, try again later."
                    ];
                }
            }
            else if($status == 2) {
                return [
                    "success"   => false,
                    "message"   => "Booking is already cancelled"
                ];
            }
            else if($status == 3) {
                return [
                    "success"   => false,
                    "message"   => "Booking is already cancelled by admin"
                ];
            }
            else if($status == 4) {
                return [
                    "success"   => false,
                    "message"   => "Booking is already accepted, contact foxcity help center to cancel it."
                ];
            }
            else if($status == 5) {
                return [
                    "success"   => false,
                    "message"   => "This booking transaction is marked as completed"
                ];
            }
            else {
                return [
                    "success"   => false,
                    "message"   => "Booking status is unknown"
                ];
            }
        }
    }
}
