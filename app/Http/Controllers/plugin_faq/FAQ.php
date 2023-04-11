<?php

namespace App\Http\Controllers\plugin_faq;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * api/plugin_faq/get
 */

class FAQ extends Controller
{
    public static function get(Request $request) {
        return DB::table("plugin_faq")->select("dataid","reference_id","question","answer")->get();
    }
}
