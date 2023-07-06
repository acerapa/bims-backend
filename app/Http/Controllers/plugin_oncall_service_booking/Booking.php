<?php

namespace App\Http\Controllers\plugin_oncall_service_booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_oncall_service_providers/booking?user_refid=&contact_person=&contact_number=&work_date=&work_time=&work_description=&address=
 */

class Booking extends Controller
{
    public static function book(Request $request) {

        if($request['user_refid'] == '') {
            return [
                "success"       => false,
                "message"       => "Unable to indentify active user"
            ];
        }
        else if($request['contact_person'] == '') {
            return [
                "success"       => false,
                "message"       => "Contact person is required"
            ];
        }
        else if($request['contact_number'] == '') {
            return [
                "success"       => false,
                "message"       => "Contact number is required"
            ];
        }
        else if($request['work_date'] == '') {
            return [
                "success"       => false,
                "message"       => "Work date is required"
            ];
        }
        else if($request['work_time'] == '') {
            return [
                "success"       => false,
                "message"       => "Call time is required"
            ];
        }
        else if($request['work_description'] == '') {
            return [
                "success"       => false,
                "message"       => "Work description is required"
            ];
        }
        else if($request['address'] == '') {
            return [
                "success"       => false,
                "message"       => "Address is required"
            ];
        }
        else if(floatval($request['provider_fee']) == 0) {
            return [
                "success"       => false,
                "message"       => "Invalid provider fee"
            ];
        }
        else if(floatval($request['foxcity_fee']) == 0) {
            return [
                "success"       => false,
                "message"       => "Invalid Foxcity fee"
            ];
        }
        else if(floatval($request['total']) == 0) {
            return [
                "success"       => false,
                "message"       => "Invalid Total fee, try again later"
            ];
        }
        else {

            $reference_id = \App\Http\Controllers\plugin_utility\CreateReferenceNo::create('plugin_oncall_service_booking');
            $convo_refid  = \App\Http\Controllers\plugin_utility\CreateReferenceNo::create('CNV');

            $booked = DB::table("plugin_oncall_service_booking")
            ->insert([
                "reference_id"      => $reference_id,
                "convo_refid"       => $convo_refid,
                "user_refid"        => $request['user_refid'],
                "provider_refid"    => $request['provider_refid'],
                "branch_refid"      => $request['branch_refid'],
                "city_code"         => $request['city_code'],
                "service_type"      => $request['service_type'],
                "contact_person"    => $request['contact_person'],
                "contact_number"    => $request['contact_number'],
                "work_date"         => $request['work_date'],
                "work_time"         => $request['work_time'],
                "work_description"  => $request['work_description'],
                "address"           => $request['address'],
                "provider_fee"      => $request['provider_fee'],
                "foxcity_fee"       => $request['foxcity_fee'],
                "days"              => $request['days'],
                "total"             => $request['total'],
                "created_at"        => date("Y-m-d h:i:s"),
            ]);

            if($booked) {
                /**
                 * Notify branch admin via notif
                 * Generate convo
                 */
                return [
                    "success"       => true,
                    "message"       => "Booked successfully"
                ];
            }
            else {
                return [
                    "success"       => false,
                    "message"       => "Booking request unsuccessful, try again later"
                ];
            }
        }
    }
}
