<?php

namespace App\Http\Controllers\plugin_order_placed;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * NOTE: Not yet tested
 * api/plugin_order_item/storeRefuseOrder?reference_id=&reason=
 */

class StoreRefuseOrder extends Controller
{
    public static function refuse(Request $request) {

        $reference_id   = $request['reference_id'];
        $reason         = $request['reason'];
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
                    "message"   => "This order already accepted by store"
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
                ->where("reference_id", $reference_id)
                ->update([
                    "store_refused"         => date("Y-m-d h:i:s"),
                    "store_refused_reason"  => $reason,
                    "status"                => 5
                ]);

                if($cancelled) {

                    /**
                     * Notify store staff
                     */

                    $cancel_item = \App\Http\Controllers\plugin_order_item\EditItemPlaced::updateStatus($reference_id, 5);

                    return [
                        "success"       => true,
                        "cancel_item"   => $cancel_item,
                        "message"       => "Successfully refused"
                    ];
                }
                else {
                    return [
                        "success"       => false,
                        "message"       => "Refusing order is not applicable"
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
