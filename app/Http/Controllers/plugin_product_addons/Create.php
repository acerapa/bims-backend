<?php

namespace App\Http\Controllers\plugin_product_addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_product_addons/create?store_refid=123&name=&price=100&photo_cover=[IMG,PATH]&created_by=Jason
 * 
 */

class Create extends Controller
{
    public static function create(Request $request) {

        $reference_id = \App\Http\Controllers\plugin_utility\CreateReferenceNo::create('PAO');

        if($request['store_refid'] == '') {
            return [
                "success"   => false,
                "message"   => "Unable to identify store, try again later."
            ];
        }
        else if($request['name'] == '' ) {
            return [
                "success"   => false,
                "message"   => "Add-on name is required"
            ];
        }
        else if($request['price'] == '' ) {
            return [
                "success"   => false,
                "message"   => "Price is required"
            ];
        }
        else {
            $created = DB::table("plugin_product_addons")->insert([
                "reference_id"      => $reference_id,
                "store_refid"       => $request['store_refid'],
                "name"              => $request['name'],
                "price"             => $request['price'],
                "photo_cover"       => $request['photo_cover'],
                "created_by"        => $request['created_by']
            ]);

            if($created) {
                
                $addons_list    = \App\Http\Controllers\plugin_product_addons\Fetch::allByStore(0, $request['store_refid']);

                return [
                    "success"       => true,
                    "message"       => "Successfully created",
                    "addons_list"   => $addons_list
                ];
            }
            else {
                return [
                    "success"       => false,
                    "message"       => "Something went wrong, please try again later."
                ];
            }
        }
    }
}
