<?php

namespace App\Http\Controllers\plugin_user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * api/plugin_user/register?firstname=firstname&lastname=lastname&mobile=mobile&email=email&password=password&photo=[]&access=2&created_by=AUTO
 */

class Register extends Controller
{
    public static function register(Request $request) {

        $reference_id       = Register::reference_id();
        $isExist_email      = \App\Http\Controllers\plugin_query\IsExist::table("plugin_user", [["reference_id","=",$request['email']]]);

        if($isExist_email > 0) {
            return [
                "success"   => false,
                "message"   => "Email already in use, please use other email"
            ];
        }
        else if($request['firstname'] == '') {
            return [
                "success"   => false,
                "message"   => "Firstname is required"
            ];
        }
        else if($request['lastname'] == '') {
            return [
                "success"   => false,
                "message"   => "Lastname is required"
            ];
        }
        else if($request['email'] == '') {
            return [
                "success"   => false,
                "message"   => "Email is required"
            ];
        }
        else if($request['password'] == '') {
            return [
                "success"   => false,
                "message"   => "Password is required"
            ];
        }
        else {
            $created = DB::table("plugin_user")->insert([
                "reference_id"  => $reference_id,
                "firstname"     => $request['firstname'],
                "lastname"      => $request['lastname'],
                "mobile"        => $request['mobile'],
                "email"         => $request['email'],
                "password"      => $request['password'],
                "photo"         => $request['photo'],
                "access"        => $request['access'],
                "created_at"    => date("Y-m-d h:i:s"),
                "created_by"    => $request['created_by']
            ]);

            if($created) {
                DB::table("plugin_user_social_media")->insert(["user_refid" => $reference_id]);
                return [
                    "success"       => true,
                    "message"       => "Account successfully created",
                    "reference_id"  => $reference_id
                ];
            }
            else {
                return [
                    "success"       => false,
                    "message"       => "Something went wrong, please try again later.",
                    "reference_id"  => null
                ];
            }
        }
    }

    public static function reference_id() {
        $DATE   = date('m').date('d').date('Y').date('h').date('i').date('s');
        $CHAR   = str_shuffle("1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ");
        return "TKN-".$DATE."-".substr($CHAR, 0, 3);
    }
}
