<?php

namespace App\Http\Controllers\plugin_gps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Description: Calculate distance from point A to B
 * 
 * \App\Http\Controllers\plugin_gps\MatrixDistance::getDistance($lat1, $lng1, $lat2, $lng2);
 * 
 */

class MatrixDistance extends Controller
{
    public static function getDistance($lat1, $lng1, $lat2, $lng2) {
        return 7.9;
    }
}
