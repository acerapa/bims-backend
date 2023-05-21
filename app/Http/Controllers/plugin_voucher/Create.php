<?php

namespace App\Http\Controllers\plugin_voucher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * api/plugin_voucher/create?copies=10&creator_type=STR&creator_refid=123&min_order_cost=190&voucher_type=FREE_DEL&voucher_label=Free%20delivery&voucher_value=50&valid_from=2023-05-30&valid_until=2023-06-30
 * 
 */

class Create extends Controller
{
    public static function create(Request $request) {
        
        $copies                 = $request['copies'];
        $copy_group_refid       = \App\Http\Controllers\plugin_utility\CreateReferenceNo::create('VCG');
        $list                   = [];

        for($i = 0; $i < $copies; $i++) {
            $copy_num           = $i + 1;
            $reference_id       = \App\Http\Controllers\plugin_utility\CreateReferenceNo::create('plugin_voucher');
            $created = DB::table("plugin_voucher")->insert([
                "reference_id"          => $reference_id,
                "copy_num"              => $copy_num,
                "copy_group_refid"      => $copy_group_refid,
                "creator_type"          => $request['creator_type'],
                "creator_refid"         => $request['creator_refid'],
                "min_order_cost"        => $request['min_order_cost'],
                "voucher_type"          => $request['voucher_type'],
                "voucher_label"         => $request['voucher_label'],
                "voucher_value"         => $request['voucher_value'],
                "valid_from"            => $request['valid_from'],
                "valid_until"           => $request['valid_until']
            ]);

            if($created) {
                $list[] = [
                    "success"           => true,
                    "message"           => "Created from number " . $copy_num . " with Ref. No.: " . $reference_id
                ];
            }
            else {
                $list[] = [
                    "success"           => false,
                    "message"           => "Unable to create voucher for number " . $copy_num . " with Ref. No.: " . $reference_id
                ];
            }
        }

        return $list;
    }
}
