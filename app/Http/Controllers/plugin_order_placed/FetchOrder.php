<?php

namespace App\Http\Controllers\plugin_order_placed;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * \App\Http\Controllers\plugin_order_placed\FetchOrder::header($reference_id);
 * 
 */

class FetchOrder extends Controller
{
    public static function header($reference_id) {
        return DB::table("plugin_order_placed")->where("reference_id", $reference_id)->get();
    }
}
