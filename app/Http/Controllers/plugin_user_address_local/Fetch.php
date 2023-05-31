<?php

namespace App\Http\Controllers\plugin_user_address_local;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * \App\Http\Controllers\plugin_user_address_local\Fetch::get($json_file, $user_refid);
 */

class Fetch extends Controller
{
    public static function get($json_file, $user_refid) {

        $file_path      = "plugin_user_address_local/". $user_refid .".json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if(($json_exist) && ($json_file == 1)) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {
            $source = DB::table("plugin_user_address_local")->where("user_refid", $user_refid)->get();
            if(count($source) > 0) {
                $data = [
                    "address_refid"     => $source[0]->reference_id,
                    "user_refid"        => $source[0]->user_refid,
                    "address"           => $source[0]->address,
                    "landmark"          => $source[0]->landmark,
                    "note_to_rider"     => $source[0]->note_to_rider,
                    "info_json"         => json_decode($source[0]->info_json)
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
