<?php

namespace App\Http\Controllers\plugin_user_address_local;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_user_address_local/create?address=address&landmark=landmark&note_to_rider=note_to_rider&info_json=info_json_upodated&user_refid=user_refid
 * 
 */

class Create extends Controller
{
    public static function create(Request $request) {

        $count = \App\Http\Controllers\plugin_query\IsExist::isExist("plugin_user_address_local", [['user_refid','=', $request['user_refid']]]);

        if($count == 0) {
            $reference_id = \App\Http\Controllers\plugin_utility\CreateReferenceNo::create('plugin_user_address_local');

            $created = DB::table("plugin_user_address_local")->insert([
                "reference_id"  => $reference_id,
                "user_refid"    => $request['user_refid'],
                "address"       => $request['address'],
                "landmark"      => $request['landmark'],
                "note_to_rider" => $request['note_to_rider'],
                "info_json"     => $request['info_json']
            ]);

            if($created) {
                $data = \App\Http\Controllers\plugin_user_address_local\Fetch::get(0, $request['user_refid']);
                return [
                    "success"   => true,
                    "message"   => "Local delivery address created successfully",
                    "data"      => $data
                ];
            }
            else {
                return [
                    "success"   => false,
                    "message"   => "Something went wrong, try again later."
                ];
            }
        }
        else {
            $created = DB::table("plugin_user_address_local")
            ->where("user_refid", $request['user_refid'])
            ->update([
                "address"       => $request['address'],
                "info_json"     => $request['info_json']
            ]);

            if($created) {
                return [
                    "success"   => true,
                    "message"   => "Local delivery address updated successfully"
                ];
            }
            else {
                return [
                    "success"   => false,
                    "message"   => "Something went wrong, try again later."
                ];
            }
        }
    }
}
