<?php

namespace App\Http\Controllers\plugin_oncall_service_providers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_oncall_service_providers/profile/1/OSP-07042023070302-KGO
 * 
 */

class Profile extends Controller
{
    public static function get($json_file, $provider_refid) {

        $json_file = intval($json_file);

        if($json_file == 1) {
            return [];
        }
        else {
            return [
                "header"    => Profile::header($provider_refid),
                "reviews"   => []
            ];
        } 
    }

    public static function header($provider_refid) {
        $data = DB::table("plugin_oncall_service_providers")->get();
        if(count($data) > 0) {
            return [
                "reference_id"              => $data[0]->reference_id,
                "branch_refid"              => $data[0]->branch_refid,
                "city_code"                 => $data[0]->city_code,
                "fname"                     => $data[0]->fname,
                "lname"                     => $data[0]->lname,
                "address"                   => $data[0]->address,
                "email"                     => $data[0]->email,
                "mobile"                    => $data[0]->mobile,
                "service"                   => $data[0]->service,
                "service_text"              => \App\Http\Controllers\plugin_oncall_service_providers\Fetch::service_text($data[0]->service),
                "service_description"       => $data[0]->service_description,
                "available"                 => $data[0]->available,
                "review_score"              => $data[0]->review_score,
                "recommended"               => $data[0]->recommended,
                "profile_photo"             => json_decode($data[0]->profile_photo),
                "cover_photo"               => json_decode($data[0]->cover_photo)
            ];
        }
        else {
            return [];
        }
    }
}
