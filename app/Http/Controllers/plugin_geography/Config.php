<?php

namespace App\Http\Controllers\plugin_geography;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_geography/allRegion
 * plugin_geography/allActiveCityWithProvice
 * plugin_geography/allProvince/01
 * plugin_geography/allProvince/all
 * plugin_geography/allCity/0128
 * 
 */

class Config extends Controller
{
    public static function allRegion() {
        return DB::table("plugin_geo_region")->orderBy("regDesc","asc")->get();
    }

    public static function allProvince($region_code) {
        if($region_code == 'all') {
            return DB::table("plugin_geo_province")
            ->select("provDesc","regCode","provCode")
            ->where("status", "1")
            ->orderBy("provDesc","asc")
            ->get();
        }
        else {
            return DB::table("plugin_geo_province")
            ->select("provDesc","regCode","provCode")
            ->where([
                ["regCode", $region_code],
                ["status", "1"]
            ])
            ->orderBy("provDesc","asc")
            ->get();
        }
    }

    public static function allCity($province_code) {
        return DB::table("plugin_geo_citymun")
        ->select("citymunCode","citymunDesc","regDesc as regCode","provCode")
        ->where([
            ["provCode", $province_code],
            ["status","1"]
        ])
        ->orderBy("citymunDesc","asc")
        ->get();
    }

    public static function allBarangay($city_code) {
        return DB::table("plugin_geo_brgy")->where("citymunCode", $city_code)->orderBy("brgyDesc","asc")->get();
    }

    public static function allActiveRegion() {
        return DB::table("plugin_geo_region")->where("status","1")->orderBy("regDesc","asc")->get();
    }

    public static function allActiveProvince($region_code) {
        return DB::table("plugin_geo_province")->where([["regCode", $region_code],["status","1"]])->orderBy("provDesc","asc")->get();
    }

    public static function allActiveCity($province_code) {
        return DB::table("plugin_geo_citymun")->where([["provCode", $province_code],"status", "1"])->orderBy("citymunDesc","asc")->get();
    }

    public static function allActiveBarangay($city_code) {
        return DB::table("plugin_geo_brgy")->where([["citymunCode", $city_code],["status", "1"]])->orderBy("brgyDesc","asc")->get();
    }

    public static function allActiveCityWithProvice() {
        return DB::table("plugin_geo_citymun")
        ->join("plugin_geo_province","plugin_geo_citymun.provCode","=","plugin_geo_province.provCode")
        ->select(
            "plugin_geo_citymun.citymunDesc",
            "plugin_geo_citymun.citymunCode",
            "plugin_geo_province.provDesc",
            "plugin_geo_province.provCode"
        )
        ->where("plugin_geo_citymun.status","=","1")
        ->orderBy("plugin_geo_citymun.citymunDesc","ASC")
        ->get();
    }
}
