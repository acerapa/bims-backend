<?php

namespace Project\Foxcity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**************************************************************
 *      Check if user exist in new database, if exist update 
 *      else register as new user.
 **************************************************************
 *      foxcity/userRegistrationClone?reference_id=56790&first_name=sdds&last_name=sdsd&middlename=sdsd&mobile=ds&email=sdsd&password=sds&photo=sd
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
            
            $notif = \App\Http\Controllers\plugin_user_notifications\Create::create(
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

            $personalize        = \App\Http\Controllers\plugin_user_personalize\Init::init($request['reference_id']);
            $social_media       = \App\Http\Controllers\plugin_user_social_media\Init::init($request['reference_id']);

            return [
                "success"           => true,
                "message"           => "Account successfully created",
                "notif"             => $notif,
                "personalize"       => $personalize,
                "social_media"      => $social_media
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
