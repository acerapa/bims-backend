<?php

namespace App\Http\Controllers\plugin_product_pricing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_product_pricing/setAddons?product_refid=PRD-05102023024701-NKA&addons=[]
 * 
 */

class SetAddons extends Controller
{
    public static function set(Request $request) {
        $data = DB::table("plugin_product_pricing")
        ->where("product_refid", $request['product_refid'])
        ->update([
            "addons" => $request['addons'],
        ]);

        if($data) {
            return [
                "success"   => true,
                "message"   => "Addons successfully set"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Request unsuccessful"
            ];
        }
    }  
}
