<?php

namespace App\Http\Controllers\plugin_inquiry_web_form;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * api/plugin_inquiry_web_form/markAsDone?inquiry_refid=INQ-03142023041637-VPU&done_by=Jason
 */

class MarkAsDone extends Controller
{
    public static function done(Request $request) {
        $data = DB::table("plugin_inquiry_web_form")
        ->where("reference_id", $request['inquiry_refid'])
        ->update([
            "done"  => 1,
            "done_by" => $request['done_by'],
            "done_date" => date("Y-m-d h:i:s")
        ]);

        if($data) {
            return [
                "success"   => true,
                "message"   => "Successfully marked as done"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Something went wrong"
            ];
        }
    }
}
