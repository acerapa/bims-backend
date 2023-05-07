<?php

namespace App\Http\Controllers\plugin_order_placed;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * \App\Http\Controllers\plugin_order_placed\Config::var();
 * 
 */

class Config extends Controller
{
    public static function var() {
        return [
            "based_delivery_fee"    => 49,
            "next_km_charges"       => 10
        ];
    }
}
