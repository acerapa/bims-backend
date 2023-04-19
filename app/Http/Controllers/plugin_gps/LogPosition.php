<?php

namespace App\Http\Controllers\plugin_gps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//api/plugin_gps/log_position?obj_type=1&obj_refid=eeee&latitude=333&longitude=11&accuracy=34&speed=34

class LogPosition extends Controller
{
    public static function log(Request $request) {
        $logged = DB::table("plugin_gps")->insert([
            "obj_type"      => $request['obj_type'],
            "obj_refid"     => $request['obj_refid'],
            "latitude"      => $request['latitude'],
            "longitude"     => $request['longitude'],
            "accuracy"      => $request['accuracy'],
            "speed"         => $request['speed'],
        ]);

        if($logged) {
            return [
                "success"   => true,
                "message"   => "Sucessfully logged"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Fail to log"
            ];
        }
    }
}
