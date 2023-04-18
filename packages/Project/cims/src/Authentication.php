<?php

namespace Project\CIMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Authentication extends Controller
{
    public static function accessStaffBarangay(Request $request) {
        return DB::table("cims_access")->insert([
            "user_refid"    => $request['user_refid'],
            "city_code"     => $request['city_code'],
            "brgy_code"     => $request['brgy_code'],
            "create_at"     => date("Y-m-d h:i:s"),
            "created_by"    => $request['created_by']
        ]);
    }
    
    public static function cityHall(Request $request) {
        return $request;
    }

    public static function barangayHall(Request $request) {

        $user = DB::table('plugin_user')
        ->select("dataid","reference_id","firstname","lastname","mobile","email","photo","access","status")
        ->where([
            ["email", $request['email']],
            ["password", $request['password']]
        ])
        ->get();

        if(count($user) > 0) {

            $access_token   = \App\Http\Controllers\plugin_email_pass_auth_otp\Config::token();
            $user_refid     = $user[0]->reference_id;
            $permission     =  DB::table("cims_access")
                ->where([
                    ["user_refid", $user_refid],
                    ["city_code", $request['city_code']],
                    ["brgy_code", $request['brgy_code']],
                    ["status", "1"]
                ])
                ->count();
            if($permission > 0) {
                DB::table('plugin_user_authentication')
                ->insert([
                    "reference_id"        => $access_token,
                    "otp"                 => "000000",
                    "verified"            => 0,
                    "user_refid"          => $user_refid,
                    "user_credential"     => json_encode($user[0]),
                    "device_credential"   => $request['device'],
                    "date_login"          => $request['datetime']
                ]);
                return [
                    "success"   => true,
                    "message"   => "Authenticated",
                    "token"     => $access_token,
                    "user_data" => $user[0]
                ];
            }
            else {
                return [
                    "success"   => false,
                    "message"   => "You don't have permission to access the selected location, please select city and barangay with permission only.",
                    "token"     => null,
                    "user_data" => null
                ];
            }    
        }
        else {
            return [
                "success"   => false,
                "message"   => "Incorrect email or password",
                "token"     => null,
                "user_data" => []
            ];
        }

        $access = DB::table("cims_access")->where([["city_code", $city_code],["brgy_code", $brgy_code],["user_refid", $user_refid]])->count();
    }

    public static function policeStation(Request $request) {
        return $request;
    }

    public static function healthCenter(Request $request) {
        return $request;
    }
}
