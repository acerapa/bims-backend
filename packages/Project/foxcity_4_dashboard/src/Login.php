<?php

namespace Project\Foxcity4Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * foxcity_4_dashboard/login?email=talisay@foxcityph.com&password=talisay_7834
 * 
 */

class Login extends Controller
{
    public static function login(Request $request) {
        $auth = DB::table("plugin_branch_access")
        ->select("name","email","branch_refid","status")
        ->where([
            ["email", $request['email']],
            ["password", $request['password']],
            ["status", 1]
        ])
        ->get();

        if(count($auth) > 0) {
            $data                   = $auth[0];
            return [
                "success"           => true,
                "user_info"         => $data,
                "branch_info"       => \App\Http\Controllers\plugin_branch\Fetch::get(1, $data->branch_refid)
            ];
        }
        else {
            return [
                "success"           => false,
                "message"           => "Incorrect email or password"
            ];
        }
    }
}