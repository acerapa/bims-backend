<?php

namespace App\Http\Controllers\plugin_user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChangePassword extends Controller
{
    public static function change(Request $request) {

        $user_refid         = $request['user_refid'];
        $current_pass       = $request['current_pass'];
        $new_pass           = $request['new_pass'];
        $confirm_pass       = $request['confirm_pass'];
        $isCurrentPassword  = ChangePassword::isCurrentPassword($user_refid, $current_pass);

        if($new_pass !== $confirm_pass) {
            return [
                "success"   => false,
                "message"   => "New password and confirmation password doesn't match."
            ];
        }
        else if($isCurrentPassword == 0) {
            return [
                "success"   => false,
                "message"   => "Your current password is incorrect."
            ];
        }
        else if($current_pass == '') {
            return [
                "success"   => false,
                "message"   => "Please confirm your current password to continue"
            ];
        }
        else if($new_pass == '') {
            return [
                "success"   => false,
                "message"   => "Please provide your new password"
            ];
        }
        else if($confirm_pass == '') {
            return [
                "success"   => false,
                "message"   => "Please confirm your new password"
            ];
        }
        else {
            $updated = DB::table("plugin_user")
            ->where([
                ["reference_id", "=", $user_refid],
                ["password", "=", $current_pass]
            ])
            ->update([
                "password" => $new_pass
            ]);

            if($updated) {
                return [
                    "success"   => true,
                    "message"   => "Password successfully updated"
                ];
            }
            else {
                return [
                    "success"   => false,
                    "message"   => "Please confirm your new password"
                ];
            }
        }
    }

    public static function isCurrentPassword($user_refid, $current_pass) {
        return DB::table("plugin_user")
        ->where([
            ["reference_id", "=", $user_refid],
            ["password", "=", $current_pass]
        ])
        ->count();
    }
}
