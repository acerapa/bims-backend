<?php

namespace App\Http\Controllers\plugin_branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * \App\Http\Controllers\plugin_branch\Fetch::get($json_file, $branch_refid);
 * 
 */

class Fetch extends Controller
{
    public static function get($json_file, $branch_refid) {

        $json_file      = intval($json_file);
        $file_path      = "plugin_branch/". $branch_refid .".json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if(($json_exist) && ($json_file == 1)) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {
            $source = DB::table("plugin_branch")->where("reference_id", $branch_refid)->get();
            if(count($source) > 0) {
                $data = [
                    "branch_refid"          => $source[0]->reference_id,
                    "name"                  => $source[0]->name,
                    "open"                  => $source[0]->open,
                    "chat_admin"            => json_decode($source[0]->chat_admin),
                    "neighboring_cities"    => json_decode($source[0]->neighboring_cities),
                    "service_food"          => $source[0]->service_food,
                    "service_food_first_km" => floatval($source[0]->service_food_first_km),
                    "service_food_next_km"  => floatval($source[0]->service_food_next_km),
                    "service_food_km_limit" => floatval($source[0]->service_food_km_limit),
                    "service_pabili"        => $source[0]->service_pabili,
                    "service_pasakay"       => $source[0]->service_pasakay
                ];
            }
            else {
                $data = [];
            }
            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data);
            return $data;
        }
    }
}
