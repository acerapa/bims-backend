<?php

namespace App\Http\Controllers\plugin_banner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * \App\Http\Controllers\plugin_banner\Fetch::get();
 */

class Fetch extends Controller
{
    public static function get($group) {
        $data = DB::table("plugin_banner")
        ->select("reference_id","photo","date_start","date_end","status")
        ->whereDate('date_start', '<=', Carbon::now())
        ->whereDate('date_end', '>=', Carbon::now())
        ->where("group", $group)
        ->get();
        if(count($data) > 0) {
            $list = [];
            foreach($data as $banner) {
                $list[] = [
                    "reference_id"  => $banner->reference_id,
                    "photo"         => json_decode($banner->photo),
                    "date_start"    => $banner->date_start,
                    "date_end"      => $banner->date_end,
                    "status"        => $banner->status
                ];
            }
            return $list;
        }
        else {
            return [];
        }
    }
}
