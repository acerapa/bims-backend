<?php

namespace App\Http\Controllers\plugin_messenger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * \App\Http\Controllers\plugin_messenger\CreateConvo::createHeader($convo_refid, $branch_refid, $name, $icon_path);
 * \App\Http\Controllers\plugin_messenger\CreateConvo::addMember($convo_refid, $user_refid, $position);
 * \App\Http\Controllers\plugin_messenger\CreateConvo::sysMessage($convo_refid, $content);
 */

class CreateConvo extends Controller
{
    public static function createHeader($convo_refid, $branch_refid, $name, $icon_path) {
        return DB::table("plugin_message_convo")
        ->insert([
            "reference_id"  => $convo_refid,
            "branch_refid"  => $branch_refid,
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

    public static function sysMessage($convo_refid, $content) {
        return DB::table("plugin_message_thread")
        ->insert([
            "convo_refid"   => $convo_refid,
            "user_refid"    => "system",
            "type"          => "TXT",
            "content"       => $content
        ]);
    }
}
