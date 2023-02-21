<?php

namespace App\Http\Controllers\plugin_blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetSingle extends Controller
{
    public static function get(Request $request) {
        return $request;
    }
}
