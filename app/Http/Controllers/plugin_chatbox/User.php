<?php

namespace App\Http\Controllers\plugin_chatbox;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * api/plugin_chatbox/create_user?
 * 
 */

class User extends Controller
{
    public static function create(Request $request) {
        $data = DB::table("plugin_chatbox_users")->insert([
            "user_refid"        => $request['user_refid'],
            "name"              => $request['name'],
            "email"             => $request['email'],
            "mobile"            => $request['mobile'],
        ]);
        if($data) {
            return [
                "success"   => true,
                "message"   => "Inserted successfully.",
                "dataid"    => $data
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Insertion not successful.",
                "dataid"    => null
            ];
        }
    }

    public static function isExist() {
        return DB::table("plugin_chatbox_users")->get();
    }
}
