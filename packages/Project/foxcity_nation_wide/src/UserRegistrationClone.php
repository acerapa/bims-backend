<?php

namespace Project\Foxcity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**************************************************************
 *      Check if user exist in new database, if exist update 
 *      else register as new user.
 **************************************************************
 *      foxcity/userRegistrationClone?user_refid=&firstname=&lastname=&middlename=&mobile=&email=&password=&photo=
 * 
 */

class UserRegistrationClone extends Controller
{
    public static function clone(Request $request) {
        $count = UserRegistrationClone::isExist($request['reference_id']);
        if($count == 0) {
            return UserRegistrationClone::create($request);
        }
        else {
            return UserRegistrationClone::update($request);
        }
    }

    public static function isExist($user_refid) {
        return DB::table("plugin_user")->where("reference_id", $user_refid)->count();
    }

    public static function update($request) {
        $created = DB::table("plugin_user")
        ->where("reference_id", $request['reference_id'])
        ->update([
            "firstname"     => $request['first_name'],
            "lastname"      => $request['last_name'],
            "middlename"    => null,
            "mobile"        => $request['mobile'],
            "email"         => $request['email'],
            "password"      => $request['password'],
            "photo"         => null
        ]);

        if($created) {
            return [
                "success"   => true,
                "message"   => "Account successfully updated"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Fail to update your account to Foxcity Nation Wide, please try again later."
            ];
        }
    }

    public static function create($request) {
        
        $created = DB::table("plugin_user")->insert([
            "reference_id"  => $request['reference_id'],
            "firstname"     => $request['first_name'],
            "lastname"      => $request['last_name'],
            "mobile"        => $request['mobile'],
            "email"         => $request['email'],
            "password"      => $request['password'],
        ]);

        if($created) {
            
            \App\Http\Controllers\plugin_user_notifications\Create::create(
                $request['reference_id'], 
                "info", 
                "Welcome to Foxcity Nation Wide!", 
                "We are excited to shocase the latest development of Foxcity PH, we are now available anywhere in the country, interested to become a Merchant? Apply now!",
                [
                    "type"      => "button",
                    "class"     => "btn btn-primary",
                    "text"      => "Apply Now",
                    "link"      => "www.link.com/apply-form/127789"
                ],
                1
            );

            return [
                "success"   => true,
                "message"   => "Account successfully created"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Fail to clone your account to Foxcity Nation Wide, please try again later."
            ];
        }
    }
}
