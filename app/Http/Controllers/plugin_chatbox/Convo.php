<?php

namespace App\Http\Controllers\plugin_chatbox;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Convo extends Controller
{
    public static function create(Request $request) {
        $created = DB::table("plugin_chatbox_convo")->insert([
            "reference_id"      => $request['convo_refid'],
            "name"              => $request['name'],
            "subject"           => $request['subject'],
            "subject_refid"     => $request['subject_refid'],
            "subject_link"      => $request['subject_link'],
            "created_by"        => $request['user_refid']
        ]);

        if($created) {
            return [
                "success"   => true,
                "message"   => "Inserted successfully."
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Insertion not successful."
            ];
        }
    }

    public static function addMemberRecepient(Request $request) {

        $recepient      = $request['recepients'];
        $client_refid   = $request['client_refid'];

        $client = DB::table("plugin_chatbox_member")->insert([
            "convo_refid"   => $request['convo_refid'],
            "user_refid"    => $client_refid
        ]);

        $agent_list = [];
        for($i = 0; $i < count($recepient); $i++) {
            $agent_list[] = DB::table("plugin_chatbox_member")->insert([
                "convo_refid"   => $request['convo_refid'],
                "user_refid"    => $recepient[$i]['user_refid']
            ]);
        }

        return [
            "success"       => true,
            "message"       => "Members added",
            "client"        => $client,
            "agent_list"    => $agent_list
        ];

    }
}
