<?php

namespace App\Http\Controllers\plugin_store_menu_group;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Create extends Controller
{
    public static function create() {

        $reference_id = \App\Http\Controllers\plugin_utility\CreateReferenceNo::create('plugin_store_menu_group');

        $created = DB::table("plugin_store_menu_group")->insert([
            "reference_id"      => $reference_id,
            "store_refid"       => $request['store_refid'],
            "name"              => $request['name'],
            "created_by"        => $request['user_refid']
        ]);

        if($created) {
            return [
                "success"       => true,
                "message"       => "Successfully created",
                "reference_id"  => $reference_id
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
