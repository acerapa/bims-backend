<?php

namespace App\Http\Controllers\plugin_vehicle_rent_vehicles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_vehicle_rent_vehicles/fetch?user_refid=USR-033121093459-TCS&city_code=072250&group=MTRCL
 * 
 */

class Fetch extends Controller
{
    public static function fetch(Request $request) {
        return  $request;
    }
}
