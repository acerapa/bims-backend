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
        $insertion_result = self::insert_resident($request->all());

        if(!$insertion_result['error']) {
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

    private static function insert_resident($resident) {
        $mobile         = $resident['user_basic']['mobile'];
        $email          = $resident['user_basic']['email'];

        if($email !== 'NA') {
            $isExistEmail  = \App\Http\Controllers\plugin_query\IsExist::isExist("plugin_user", [['email','=', $email]]);

            if($isExistEmail > 0) {
                return [
                    "error"   => true,
                    "message"   => "Email already in used"
                ];
            }
        }

        $create_user_column = DB::table("plugin_user")->insertGetId($resident['user_basic']);

        if($create_user_column) {
            $create_loca_column = DB::table("cims_user_location")->insertGetId($resident['user_location']);
            return [
                'error' => false,
                'message' => "Successfully Registered"
            ];
        }
        else {
            return [
                'error' => true,
                'message' => "Failed to add Resident"
            ];
        }
    }

    public static function bulk_register(Request $request) {
        $resident_w_errors = [];

        foreach ($request->data as $resident) {
            $result = self::insert_resident($resident);

            if ($result['error']) {
                array_push($resident_w_errors, [
                    'resident' => $resident,
                    'message' => $result['message']
                ]);
            }
        }

        return [
            'resident_with_errors' => $resident_w_errors,
            'no_resident_uploaded' => count($request->data) - count($resident_w_errors),
            'no_resident_not_uploaded' => count($resident_w_errors)
        ];
    }
}
