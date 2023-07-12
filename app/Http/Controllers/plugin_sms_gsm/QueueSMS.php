<?php

namespace App\Http\Controllers\plugin_sms_gsm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 **********************************************************************************************
 *      Use this method or URI to queue message
 **********************************************************************************************
 *      api/plugin_sms_gsm/fetchQuee
 * 
 * 
 **********************************************************************************************
 *      Use this method or URI to queue message
 **********************************************************************************************
 *      api/plugin_sms_gsm/method/user_refid/639353152023/Hi this is the message
 *      \App\Http\Controllers\plugin_sms\QueueSMS::method($user_refid, $mobile, $message);
 * 
 */

class QueueSMS extends Controller
{
    public static function method($user_refid, $mobile, $message) {
        
        $queue = DB::table("plugin_sms_gsm")->insert([
            "user_refid"    => $user_refid,
            "mobile"        => $mobile,
            "message"       => $message
        ]);

        if($queue) {
            QueueSMS::createJSONFileQuee();
            return true;
        }
        else {
            return false;
        }

    }

    public static function createJSONFileQuee() {
        
        $file_path      = "plugin_sms_gsm/queue_sms.json";
        $data           = DB::table("plugin_sms_gsm")->where("status", 1)->orderBy("dataid","asc")->get();

        \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data);
    }

    public static function fetchQuee() {

        $file_path      = "plugin_sms_gsm/queue_sms.json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if($json_exist) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {
            return [];
        }

    }
}
