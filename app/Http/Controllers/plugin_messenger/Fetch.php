<?php

namespace App\Http\Controllers\plugin_messenger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_messenger/userConvoList?user_refid=USR-033121093459-TCS&page=1
 * plugin_messenger/thread?user_refid=USR-033121093459-TCS&convo_refid=CNV-07112023124839-2VW&page=1
 * 
 */

class Fetch extends Controller
{
    public static function userConvoList(Request $request) {

        $user_refid = $request['user_refid'];

        $source = DB::table("plugin_message_convo")
        ->join("plugin_message_member","plugin_message_convo.reference_id","=","plugin_message_member.convo_refid")
        ->select(
            "plugin_message_convo.dataid",
            "plugin_message_convo.reference_id",
            "plugin_message_convo.branch_refid",
            "plugin_message_convo.name",
            "plugin_message_convo.icon_path",
            "plugin_message_convo.date_created",
            "plugin_message_convo.date_expire",
            "plugin_message_convo.status")
        ->where([
            ["plugin_message_convo.status", 1],
            ["plugin_message_member.user_refid", $user_refid]
        ])
        ->distinct("plugin_message_convo.dataid")
        ->orderBy("plugin_message_convo.dataid","desc")
        ->paginate(12)
        ->toArray();

        $data   = $source['data'];
        $list   = [];

        if(count($data) > 0) {
            
            foreach($data as $convo) {
                $list[] = [
                    "header"    => [
                        "convo_refid"   => $convo->reference_id,
                        "branch_refid"  => $convo->branch_refid,
                        "name"          => $convo->name,
                        "icon_path"     => $convo->icon_path,
                        "date_created"  => $convo->date_created,
                        "date_expire"   => $convo->date_expire,
                        "status"        => $convo->status
                    ],
                    "member"    => Fetch::members(1, $convo->reference_id)
                ];
            }
        }

        return [
            "current_page"      => $source['current_page'],
            "last_page"         => $source['last_page'],
            "from"              => $source['from'],
            "to"                => $source['to'],
            "per_page"          => $source['per_page'],
            "total"             => $source['total'],
            "data"              => $list
        ];
    }

    public static function members($json_file, $convo_refid) {
 
        $json_file      = intval($json_file);
        $file_path      = "plugin_message_member/" . $convo_refid.".json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        $data_json      = [];
        
        if(($json_exist) && ($json_file == 1)) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {

            $member = DB::table("plugin_message_member")->where("convo_refid", $convo_refid)->get();
            $list   = [];
            foreach($member as $mem) {
                $list[] = [
                    "header"    => $mem,
                    "profile"   => \App\Http\Controllers\plugin_user\GetProfile::header(1, $mem->user_refid)
                ];
            }

            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $list);
            return $list;
        }

    }

    public static function thread(Request $request) {
        $source = DB::table("plugin_message_thread")
        ->where([
            ["convo_refid", $request['convo_refid']]
        ])
        ->paginate(12)
        ->toArray();
        
        $members    = Fetch::members(1, $request['convo_refid']);
        $data       = $source['data'];
        $list       = [];

        if(count($data) > 0) {
            
            foreach($data as $thread) {

                if($thread->user_refid == $request['user_refid']) {
                    $sender_me = 1;
                }
                else {
                    $sender_me = 0;
                }

                $list[] = [
                    "header"    => [
                        "sender_refid"  => $thread->user_refid,
                        "sender_info"   => Fetch::senderName($members, $thread->user_refid),
                        "sender_me"     => $sender_me,
                        "type"          => $thread->type,
                        "content"       => $thread->content,
                        "created_at"    => $thread->created_at,
                        "status"        => $thread->status,
                    ],
                ];
            }
        }

        return [
            "current_page"      => $source['current_page'],
            "last_page"         => $source['last_page'],
            "from"              => $source['from'],
            "to"                => $source['to'],
            "per_page"          => $source['per_page'],
            "total"             => $source['total'],
            "data"              => $list,
            "members"           => $members
        ];
    }

    public static function senderName($members, $sender_refid) {
        foreach($members as $member) {
            if($sender_refid == 'system') {
                return [
                    "name"  => "Foxcity PH",
                    "role"  => "system"
                ];
            }
            else if($member['header']['user_refid'] == $sender_refid) {

                if($member['header']['position'] == 'CUSTOMER') {
                    $role = "Customer";
                }
                else if($member['header']['position'] == 'BRCH_ADMN') {
                    $role = "Branch Admin";
                }
                else {
                    $role = "Unknown";
                }

                return [
                    "name"  => $member['profile']['firstname'] . " " . $member['profile']['lastname'],
                    "role"  => $role
                ];
            }
        }
        return "Unknown sender";
    }
}   
