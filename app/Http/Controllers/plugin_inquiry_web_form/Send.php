<?php

namespace App\Http\Controllers\plugin_inquiry_web_form;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * api/plugin_inquiry_web_form/send?name=name&email=email&subject=subject&message=message
 */

class Send extends Controller
{
  public static function send(Request $request) {

    $reference_id = Send::refid();

    $header = DB::table("plugin_inquiry_web_form")->insert([
      "reference_id"  => $reference_id,
      "name"          => $request['name'],
      "email"         => $request['email'],
      "subject"       => $request['subject'],
      "message"       => $request['message'],
      "created_at"    => date("Y-m-d h:i:s"),
      "status"        => "1"
    ]);

    if($header) {
      return [
        "success" => true,
        "message" => "Inquiry sent"
      ];
    }
    else {
      return [
        "success" => false,
        "message" => "Inquiry not sent."
      ];
    }

    /*
    $tag_list         = json_decode($request['tag_list']);
    if(count($tag_list) > 0) {

    }
    */

  }

  public static function refid() {
    $DATE   = date('m').date('d').date('Y').date('h').date('i').date('s');
    $CHAR   = str_shuffle("1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ");
    return "INQ-".$DATE."-".substr($CHAR, 0, 3);
  }
}
