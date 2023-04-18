<?php

namespace App\Http\Controllers\plugin_gps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//?obj_refid=&limit=23

class GetPosition extends Controller
{
    public static function getLastPosition(Request $request) {
        return DB::table("plugin_gps")
        ->where([
            ["obj_refid", $request['obj_refid']],
            ["status", "1"]
        ])
        ->orderBy("dataid","desc")
        ->limit($request['limit'])
        ->get();
    }

}
