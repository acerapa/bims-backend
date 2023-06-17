<?php

namespace App\Http\Controllers\plugin_voucher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_voucher/claim?user_refid=123&voucher_refid=VCH-05212023123045-Y0L
 * 
 */

class Claim extends Controller
{
    public static function claim(Request $request) {

        /**
         * TO DO:
         * 1: Check if already claimed the same
         * 2: Check if voucher is expired
         */

        $user_refid         = $request['user_refid'];
        $voucher_refid      = $request['voucher_refid'];
        $copy_group_refid   = $request['copy_group_refid'];
        $voucher_info       = \App\Http\Controllers\plugin_voucher\Fetch::fetchSingleVoucher($voucher_refid);
        $isDuplicateClaim   = Claim::isDuplicateClaim($voucher_info[0]->copy_group_refid, $user_refid);

        if(count($voucher_info) <= 0) {
            return [
                "success"   => false,
                "message"   => "Voucher not found"
            ];
        }
        else if($isDuplicateClaim >= 1) {
            return [
                "success"   => false,
                "message"   => "Multiple claim of the same voucher is not allowed."
            ];
        }
        else if($voucher_info[0]->status == 2) {
            return [
                "success"   => false,
                "message"   => "Voucher already claimed by someone."
            ];
        }
        else {
            $claimed = DB::table("plugin_voucher")
            ->where([
                ["reference_id", $voucher_refid],
                ["status", 1]
            ])
            ->update([
                "claim_user_refid"  => $user_refid,
                "claim_date"        => date("Y-m-d h:i:s"),
                "status"            => 2
            ]);

            if($claimed) {
                //Notify store about the claimed voucher
                return [
                    "success"   => true,
                    "message"   => "Voucher claimed successfully"
                ];
            }
            else {
                return [
                    "success"   => false,
                    "message"   => "Voucher claimed unsuccessful"
                ];
            }
        }
    }

    public static function isDuplicateClaim($copy_group_refid, $claim_user_refid) {
        return DB::table("plugin_voucher")
        ->where([
            ["copy_group_refid", $copy_group_refid],
            ["claim_user_refid", $claim_user_refid],
            ["status",2]
        ])
        ->count();
    }

}
