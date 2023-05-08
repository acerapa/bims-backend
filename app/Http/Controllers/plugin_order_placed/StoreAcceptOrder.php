<?php

namespace App\Http\Controllers\plugin_order_placed;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * NOTE: Not yet tested
 * api/plugin_order_item/storeAcceptOrder?reference_id=
 */

class StoreAcceptOrder extends Controller
{
    public static function accept(Request $request) {

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
                    "status"    => 4
                ]);

                if($cancelled) {

                    /**
                     * Notify store staff
                     */

                    $cancel_item = \App\Http\Controllers\plugin_order_item\EditItemPlaced::updateStatus($reference_id, 4);

                    return [
                        "success"       => true,
                        "cancel_item"   => $cancel_item,
                        "message"       => "Successfully accepted"
                    ];
                }
                else {
                    return [
                        "success"       => false,
                        "message"       => "Accepting order refused by the system"
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
