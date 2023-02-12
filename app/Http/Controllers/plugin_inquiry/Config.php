<?php

namespace App\Http\Controllers\plugin_inquiry;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * api/plugin_inquiry/postInquiry?user_refid=&name=name&email=email&message=sss&mobile=mobile
 * 
 */

class Config extends Controller
{
  public static function config() {
    return [
      "enable"            => true,
      "table"             => "inquiry",
      "fetch"             => ["reference_id", "name","message","created_at","status"],
      "forward_to_email"  => [
        "enabled"         => true,
        "email"           => "jasonlipreso@gmail.com",
      ],
      "forward_to_mobile" => [
        "enabled"         => false,
        "mobile"          => ["639353152023","639353152022"]
      ]
    ];
  }

  public static function postInquiry($request) {
    $reference_id     = Config::ID();
    $create = DB::table(Config::config()['table'])->insert([
      "reference_id"  => $reference_id,
      "user_refid"    => $request['user_refid'],
      "name"          => $request['name'],
      "email"         => $request['email'],
      "mobile"        => $request['mobile'],
      "message"       => $request['message'],
    ]);
    if($create) {
      return [
        "success" => true,
        "message" => "Inquiry successfully sent",
        "refid"   => $reference_id
      ];
    }
    else {
      return [
        "success" => false,
        "message" => "Something went wrong, please try again later.",
        "refid"   => null
      ];
    }
  }

  public static function forwardToEmail($data) {
    return $request;
  }

  public static function forwardToMobile($data) {
    return $request;
  }

  public static function ID() {
    $DATE   = date('m').date('d').date('Y').date('h').date('i').date('s');
    $CHAR   = str_shuffle("1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ");
    return "INQ-".$DATE."-".substr($CHAR, 0, 3);
  }
}
