<?php

namespace App\Http\Controllers\plugin_user_notifications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*

    \App\Http\Controllers\plugin_user_notifications\Create::create($user_refid, $icon_code, $subject, $body);
    \App\Http\Controllers\plugin_user_notifications\Create::create(
        $request['user_refid'], 
        "info", 
        "Welcome to Foxcity Nation Wide!", 
        "We are excited to shocase the latest development of Foxcity PH, we are now available anywhere in the country, interested to become a Merchant? Apply now!",
        [
            "type"      => "button",
            "class"     => "btn btn-primary",
            "text"      => "Apply Now",
            "link"      => "www.link.com/apply-form/127789"
        ]
    );
 
 */

class Create extends Controller
{
    public static function create($user_refid, $icon_code, $subject, $body, $element, $push_notif_required) {
        
        $created = DB::table("plugin_user_notifications")->insert([
            "user_refid"                => $user_refid,
            "icon_code"                 => $icon_code,
            "subject"                   => $subject,
            "body"                      => $body,
            "element"                   => json_encode($element),
            "push_notif_required"       => $push_notif_required
        ]);

        if($created) {
            return [ "success"   => true ];
        }
        else {
            return [ "success"   => false ];
        }
    }
}
