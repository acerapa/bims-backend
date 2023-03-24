<?php

namespace App\Http\Controllers\plugin_user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 
 */

class GetProfile extends Controller
{
    public static function get($user_refid) {
        $profile    = DB::table("plugin_user")
                    ->select("reference_id","firstname","lastname","address","mobile","email","photo","access","status")
                    ->where("reference_id", $user_refid)
                    ->get();

        if(count($profile) == 0) {
            return [
                "success"   => false,
                "profile"   => []
            ];
        }
        else {
            $social_media   = DB::table("plugin_user_social_media")
                            ->where("user_refid", $user_refid)
                            ->get();

            if(count($social_media) == 0) {
                $social_media = [];
            }
            else {
                $social_media = $social_media[0];
            }

            return [
                "success"       => true,
                "profile"       => $profile[0],
                "social_media"  => $social_media
            ];
        }
    }
}
