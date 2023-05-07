<?php

namespace Project\MultiStoreApp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Init extends Controller
{
    public static function get($user_refid) {
        return [
            "branches"      => [],
            "mycart"        => null,
            "order_status"  => null,
            "user_profile"  => null
        ];
    }
}
