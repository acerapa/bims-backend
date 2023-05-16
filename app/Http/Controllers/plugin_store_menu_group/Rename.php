<?php

namespace App\Http\Controllers\plugin_store_menu_group;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_store_menu_group/rename?menu_refid=SMN-05162023045832-N8F&name=Sample-5&store_refid=
 * 
 */

class Rename extends Controller
{
    public static function rename(Request $request) {
        
        $renamed = DB::table("plugin_store_menu_group")
        ->where("reference_id", $request['menu_refid'])
        ->update([
            "name" => $request['name']
        ]);

        if($renamed) {

            $menu_list = \App\Http\Controllers\plugin_store_menu_group\Fetch::getAll(0, $request['store_refid']);

            return [
                "success"   => true,
                "message"   => "Successfully renamed",
                "menu_list" => $menu_list
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Renaming unsuccessful"
            ];
        }
    }
}
