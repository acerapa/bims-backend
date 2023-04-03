<?php

namespace Project\CIMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * 
 * 
 */

class ResidentRegistration extends Controller
{
    public static function register(Request $request) {

        $mobile         = $request['mobile'];
        $email          = $request['email'];

        if($mobile !== 'NA') {
            $isExistMobile  = \App\Http\Controllers\plugin_query\IsExist::isExist("plugin_user", [['mobile','=', $mobile]]);

            if($isExistMobile > 0) {
                return [
                    "success"   => true,
                    "message"   => "Mobile number already in used"
                ];
            }
        }

        if($email !== 'NA') {
            $isExistEmail  = \App\Http\Controllers\plugin_query\IsExist::isExist("plugin_user", [['email','=', $email]]);

            if($isExistEmail > 0) {
                return [
                    "success"   => true,
                    "message"   => "Mobile number already in used"
                ];
            }
        }

        $create_user_column = DB::table("plugin_user")->insertGetId($request['user_basic']);

        if($create_user_column) {
            $create_loca_column = DB::table("cims_user_location")->insertGetId($request['user_location']);
            return [
                "success"   => true,
                "message"   => "Resident successfully registered"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Unable to register user, please try again later."
            ];
        }

        

    }
}
