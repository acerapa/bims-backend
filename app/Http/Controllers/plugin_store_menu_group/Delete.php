<?php

namespace App\Http\Controllers\plugin_store_menu_group;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_store_menu_group/delete?menu_refid=STR-1234567890-234&store_refid=STR-1234567890-234
 * 
 */

class Delete extends Controller
{
    public static function delete(Request $request) {

        $deleted = DB::table("plugin_store_menu_group")->where("reference_id", $request['menu_refid'])->delete();
        
        if($deleted) {

            $menu_list  = \App\Http\Controllers\plugin_store_menu_group\Fetch::getAll(0, $request['store_refid']);
            $remove_tag = DB::table("plugin_product")->where("store_menu_refid", $request['menu_refid'])->update(["store_menu_refid" => null]);

            return [
                "success"       => true,
                "message"       => "Deleted successfully",
                "menu_list"     => $menu_list
            ];
        }
        else {
            return [
                "success"       => false,
                "message"       => "Unable to delete menu group, try again later."
            ];
        }
    }
}
