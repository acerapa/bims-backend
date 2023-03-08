<?php

namespace App\Http\Controllers\plugin_query;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Sum extends Controller
{
    public static function sum(Request $request) {
        return DB::table($request['table'])
        ->where($request['where'])
        ->sum($request['column']);
    }
}
