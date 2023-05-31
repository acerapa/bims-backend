<?php

namespace Project\Foxcity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * 
 * 
 */

class Config extends Controller
{
    public static function config() {
        return [
            "delivery" => [
                "min_km"    => 0,
                "max_km"    => 35
            ],
            "shipping"      => [
                "min_km"    => 35,
                "max_km"    => 1500
            ]
        ];
    }
}