<?php

namespace App\Http\Controllers\plugin_store_menu_group;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_store_menu_group/create?store_refid=STR-1234567890-234&name=Sample%2S&user_refid=JASON
 */

class Create extends Controller
{
    public static function create(Request $request) {

        $reference_id = \App\Http\Controllers\plugin_utility\CreateReferenceNo::create('plugin_store_menu_group');

        $created = DB::table("plugin_store_menu_group")->insert([
            "reference_id"      => $reference_id,
            "store_refid"       => $request['store_refid'],
            "name"              => $request['name'],
            "created_by"        => $request['user_refid']
        ]);

        if($created) {

            $menu_list = \App\Http\Controllers\plugin_store_menu_group\Fetch::getAll(0, $request['store_refid']);

            return [
                "success"       => true,
                "message"       => "Successfully created",
                "reference_id"  => $reference_id,
                "menu_list"     => $menu_list
            ];
        }
        else {
            return [
                "success"       => false,
                "message"       => "Unable to create menu group, please try again later."
            ];
        }
    }
}
