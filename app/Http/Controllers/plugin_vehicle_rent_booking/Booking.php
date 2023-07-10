<?php

namespace App\Http\Controllers\plugin_vehicle_rent_booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_vehicle_rent_booking/book?ok=1
 * 
 */

class Booking extends Controller
{
    public static function book(Request $request) {
        $reference_id               = \App\Http\Controllers\plugin_utility\CreateReferenceNo::create('plugin_vehicle_rent_booking');
        $convo_refid                = \App\Http\Controllers\plugin_utility\CreateReferenceNo::create('CNV');
        $posted = DB::table("plugin_vehicle_rent_booking")
        ->insert([
            "reference_id"          => $reference_id,
            "vehicle_refid"         => $request['vehicle_refid'],
            "branch_refid"          => $request['branch_refid'],
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
            "convo_refid"           => $convo_refid,
            "total"                 => $request['total'],
            "created_at"            => date("Y-m-d h:i:s"),
            "status"                => 1
        ]);

        if($posted) {

            $branch_info    = \App\Http\Controllers\plugin_branch\Fetch::get(1, $request['branch_refid']);
            $branch_admin   = $branch_info['chat_admin'];

            /**Create convo */
            \App\Http\Controllers\plugin_messenger\CreateConvo::createHeader($convo_refid, $request['branch_refid'], $request['convo_name'], null);

            /** Add customer to convo */
            \App\Http\Controllers\plugin_messenger\CreateConvo::addMember($convo_refid, $request['user_refid'], 'CUSTOMER');

            /** Send Initial Message */
            \App\Http\Controllers\plugin_messenger\CreateConvo::sysMessage($convo_refid, "Welcome! This conversation is created to allow in-app communication for Foxcity staff, admin and customer.");

            /**Notify branch admin about the booking*/
            if(count($branch_admin) > 0) {
                $message        = $branch_info['name'] . " has new booking with Ref. No.: " . $reference_id;
                $group          = "VHCL_RENT_NEW_BOOKING";
                $payload        = [
                    "booking_refid"   => $reference_id,
                    "convo_refid"     => $convo_refid,
                    "user_refid"      => $request['user_refid']
                ];
                foreach($branch_admin as $admin) {
                    \App\Http\Controllers\plugin_notification\Send::send($admin['user_refid'], $message, $group, $payload);
                    \App\Http\Controllers\plugin_messenger\CreateConvo::addMember($convo_refid, $admin['user_refid'], 'BRCH_ADMN');
                }
            }

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
