<?php

namespace App\Http\Controllers\plugin_geography;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Config extends Controller
{

    /* Fetch all data */

    public static function allRegion() {
        return DB::table("plugin_region")->orderBy("regDesc","asc")->get();
    }

    public static function allProvince($region_code) {
        return DB::table("plugin_province")->where("regCode", $region_code)->orderBy("provDesc","asc")->get();
    }

    public static function allCity($province_code) {
        return DB::table("plugin_citymun")->where("provCode", $province_code)->orderBy("citymunDesc","asc")->get();
    }

    public static function allBarangay($city_code) {
        return DB::table("plugin_brgy")->where("citymunCode", $city_code)->orderBy("brgyDesc","asc")->get();
    }

    /* Fetch all active data */

    public static function allActiveRegion() {
        return DB::table("plugin_region")->where("status","1")->orderBy("regDesc","asc")->get();
    }

    public static function allActiveProvince($region_code) {
        return DB::table("plugin_province")->where([["regCode", $region_code],["status","1"]])->orderBy("provDesc","asc")->get();
    }

    public static function allActiveCity($province_code) {
        return DB::table("plugin_citymun")->where([["provCode", $province_code],"status", "1"])->orderBy("citymunDesc","asc")->get();
    }

    public static function allActiveBarangay($city_code) {
        return DB::table("plugin_brgy")->where([["citymunCode", $city_code],["status", "1"]])->orderBy("brgyDesc","asc")->get();
    }
}
