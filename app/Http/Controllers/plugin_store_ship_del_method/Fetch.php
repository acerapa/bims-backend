<?php

namespace App\Http\Controllers\plugin_store_ship_del_method;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * \App\Http\Controllers\plugin_store_ship_del_method\Fetch::get($json_file, $store_refid);
 */

class Fetch extends Controller
{
    public static function get($json_file, $store_refid) {

        $file_path      = "plugin_store_ship_del_method/". $store_refid .".json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if(($json_exist) && ($json_file == 1)) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {
            $source = DB::table("plugin_store_ship_del_method")->select("customer_pick_up","in_house_rider","in_house_rider_cities","foxcity_rider","third_party_lbc","third_party_jnt")->where("store_refid", $store_refid)->get();
            if(count($source) > 0) {
                $data_json = [
                    "success"               => true,
                    "customer_pick_up"      => $source[0]->customer_pick_up,
                    "in_house_rider"        => $source[0]->in_house_rider,
                    "in_house_rider_cities" => json_decode($source[0]->in_house_rider_cities),
                    "foxcity_rider"         => $source[0]->foxcity_rider,
                    "third_party_lbc"       => $source[0]->third_party_lbc,
                    "third_party_jnt"       => $source[0]->third_party_jnt,
                ];
            }
            else {
                $data_json = [
                    "success"               => false,
                    "customer_pick_up"      => 0,
                    "in_house_rider"        => 0,
                    "in_house_rider_cities" => [],
                    "foxcity_rider"         => 0,
                    "third_party_lbc"       => 0,
                    "third_party_jnt"       => 0,
                ];
            }
            
            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data_json);
            return $data_json;
        }
    }
}
