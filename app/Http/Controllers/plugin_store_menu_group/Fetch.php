<?php

namespace App\Http\Controllers\plugin_store_menu_group;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * \App\Http\Controllers\plugin_store_menu_group\Fetch::getAll($json_file, $store_refid);
 * 
 */

class Fetch extends Controller
{
    public static function getAll($json_file, $store_refid) {

        $json_file      = intval($json_file);
        $file_path      = "plugin_store_menu_group/". $store_refid .".json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if(($json_exist) && ($json_file == 1)) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {
            $data = DB::table("plugin_store_menu_group")
            ->select("reference_id", "store_refid","name","status")
            ->where([
                ["store_refid", $store_refid],
                ["status", 1]
            ])
            ->orderBy("name","ASC")
            ->get();
            
            
            $list = [];
            foreach($data as $item) {
                $counts             = Fetch::count($store_refid, $item->reference_id);
                $list[] = [
                    "reference_id"  => $item->reference_id,
                    "store_refid"   => $item->store_refid,
                    "name"          => $item->name,
                    "count"         => $counts,  
                    "status"        => $item->status,
                ];
            }

            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $list);
            return $list;
            
        }
    }

    public static function count($store_refid, $menu_group_refid) {
        return DB::table("plugin_product")->where([
            "store_refid"           => $store_refid,
            "store_menu_refid"      => $menu_group_refid
        ])
        ->count();
    }
}
