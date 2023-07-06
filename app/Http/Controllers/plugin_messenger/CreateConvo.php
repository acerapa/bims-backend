<?php

namespace App\Http\Controllers\plugin_messenger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * \App\Http\Controllers\plugin_messenger\CreateConvo::createHeader($convo_refid, $name, $icon_path);
 * \App\Http\Controllers\plugin_messenger\CreateConvo::addMember($convo_refid, $user_refid, $position);
 */

class CreateConvo extends Controller
{
    public static function createHeader($convo_refid, $name, $icon_path) {
        return DB::table("plugin_message_convo")
        ->insert([
            "reference_id"  => $convo_refid,
            "name"          => $name,
            "icon_path"     => $icon_path
        ]);
    }

    public static function addMember($convo_refid, $user_refid, $position) {
        return DB::table("plugin_message_member")->insert([
            "convo_refid"   => $convo_refid,
            "user_refid"    => $user_refid,
            "position"      => $position
        ]);
    }
}
