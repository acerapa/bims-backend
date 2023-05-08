<?php

namespace App\Http\Controllers\plugin_order_placed;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * NOTE: Note yet tested
 * api/plugin_order_item/customerCancelOrder?reference_id=
 * 
 */

class CustomerCancelOrder extends Controller
{
    public static function cancel(Request $request) {

        $reference_id   = $request['reference_id'];
        $header         = \App\Http\Controllers\plugin_order_placed\FetchOrder::header($reference_id);

        if(count($header) > 0) {

            if($header[0]['status'] == '2') {
                return [
                    "success"   => false,
                    "message"   => "This order already cancelled"
                ];
            }
            else if($header[0]['status'] == '4') {
                return [
                    "success"   => false,
                    "message"   => "Store already processed the order and cancellation is not available."
                ];
            }
            else if($header[0]['status'] == '5') {
                return [
                    "success"   => false,
                    "message"   => "Store already refused the order."
                ];
            }
            else {

                $cancelled = DB::table("plugin_order_placed")
                ->where([
                    ["reference_id", $reference_id],
                    ["status", 1]
                ])
                ->update([
                    "status"    => 2
                ]);

                if($cancelled) {

                    /**
                     * Notify store staff
                     * Update item status
                     */

                    return [
                        "success"   => true,
                        "message"   => "Successfully posted"
                    ];
                }
                else {
                    return [
                        "success"   => false,
                        "message"   => "Cancel request denied"
                    ];
                }

            }
        }
        else {
            return [
                "success"   => false,
                "message"   => "Order details not found"
            ];
        }
    }
}
