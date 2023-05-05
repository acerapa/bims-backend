<?php

namespace App\Http\Controllers\plugin_store_menu_group;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * \App\Http\Controllers\plugin_store_menu_group\Fetch::getAll($store_refid);
 * 
 */

class Fetch extends Controller
{
    public static function getAll($store_refid) {
        return DB::table("plugin_store_category")
        ->select("reference_id", "store_refid","name","status")
        ->where([
            ["store_refid", $store_refid],
            ["status", 1]
        ])
        ->orderBy("name","ASC")
        ->get();
    }
}
