<?php

namespace Project\CIMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * 
 * 
 */

class BarangayProfile extends Controller
{
    public static function get(Request $request) {

        $user_refid         = $request['user_refid'];
        $city_code          = $request['city_code'];
        $brgy_code          = $request['brgy_code'];

        return [
            "user"          => [
                "profile"           => BarangayProfile::getUser($user_refid),
                "social_media"      => []
            ],
            "city"          => [
                "profile"           =>  BarangayProfile::getCity($city_code),
                "brgy_list"         =>  BarangayProfile::getBrgyList($city_code)
            ],
            "barangay"      => [
                "profile"           => BarangayProfile::getBrgy($brgy_code),
                "purok_list"        => BarangayProfile::getPurokList($brgy_code),
                "sitio_list"        => BarangayProfile::getSitioList($brgy_code),
                "household_list"    => BarangayProfile::getHouseholdList($brgy_code)
            ],
        ];
    }

    public static function getHouseholdList($brgy_code) {
        return DB::table("cims_household")
        ->select("reference_id","name","ownership","owner_refid","sitio_refid","purok_refid","latitude","longitude","created_at","created_by")
        ->where("brgy_code", $brgy_code)
        ->orderBy("name")
        ->get();
    }

    public static function getSitioList($brgy_code) {
        return DB::table("cims_sitio")
        ->select("reference_id","name")
        ->where("brgy_code", $brgy_code)
        ->orderBy("name","asc")
        ->get();
    }

    public static function getPurokList($brgy_code) {
        return DB::table("cims_purok")
        ->select("reference_id","name")
        ->where("brgy_code", $brgy_code)
        ->orderBy("name","asc")
        ->get();
    }

    public static function getBrgy($brgy_code) {
        $data = DB::table("plugin_geo_brgy")
        ->select("brgyCode","brgyDesc","regCode","provCode","citymunCode")
        ->where("brgyCode", $brgy_code)
        ->get();
        if(count($data) > 0) {
            return $data[0];
        }
        else {
            return [];
        }
    }

    public static function getBrgyList($city_code) {
        return DB::table("plugin_geo_brgy")
        ->select("brgyCode","brgyDesc","regCode","provCode","citymunCode")
        ->where("citymunCode", $city_code)
        ->orderBy("brgyDesc","asc")
        ->get();
    }

    public static function getCity($city_code) {
        $data = DB::table("plugin_geo_citymun")
        ->select("citymunDesc","regDesc","provCode","citymunCode")
        ->where("citymunCode", $city_code)
        ->get();
        if(count($data) > 0) {
            return $data[0];
        }
        else {
            return [];
        }
    }

    public static function getUser($user_refid) {
        $data = DB::table("plugin_user")
        ->select("firstname","lastname","middlename","gender","birthday","mobile","email","photo")
        ->where("reference_id", $user_refid)
        ->get();
        if(count($data) > 0) {
            return $data[0];
        }
        else {
            return [];
        }
    }
}
