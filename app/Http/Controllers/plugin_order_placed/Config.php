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
            "first_km_rate"         => 49,
            "next_km_rate"          => 10
        ];
    }
}
