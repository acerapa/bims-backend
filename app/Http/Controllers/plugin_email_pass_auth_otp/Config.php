<?php

namespace App\Http\Controllers\plugin_email_pass_auth_otp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*

\App\Http\Controllers\plugin_email_pass_auth_otp\Config::auth($email, $password);
\App\Http\Controllers\plugin_email_pass_auth_otp\Config::verify($request);
\App\Http\Controllers\plugin_email_pass_auth_otp\Config::isTokenActive($token_refid, $user_refid);
api/plugin_email_pass_auth_otp/authBasic?email=email&password=password&device=&datetime=

*/

class Config extends Controller
{
  public static function config() {
    return [
      "enable_otp_sms"      => true,
      "table_users"         => "user",
      "table_auth"          => "user_authentication",
      "fetch"               => ["reference_id", "firstname", "lastname","mobile","email","photo"],
      "incorrect_message"   => "Incorrect email or password"
    ];
  }

  public static function authBasic($request) {
    $user = DB::table("user")
    ->select("reference_id","firstname","lastname","mobile","email")
    ->where([
      ["email", $request['email']],
      ["password", $request['password']]
    ])->get();
    if(count($user) > 0) {
      $access_token = Config::token();
      DB::table("user_authentication")->insert([
        "reference_id"        => $access_token,
        "otp"                 => "000000",
        "verified"            => 0,
        "user_refid"          => $user[0]->reference_id,
        "user_credential"     => json_encode($user[0]),
        "device_credential"   => $request['device'],
        "date_login"          => $request['datetime']
      ]);

      return [
        "success"   => true,
        "message"   => "Authenticated",
        "token"     => $access_token,
        "user_data" => $user[0]
      ];
    }
    else {
      return [
        "success"   => false,
        "message"   => "Incorrect email or password",
        "token"     => null,
        "user_data" => []
      ];
    }
  }

  public static function authLogout($token) {
    $logout = DB::table("user")
    ->where("reference_id", $token)
    ->update([
      "date_logout" => date("Y-m-d h:i:s"),
      "status"      => "2"
    ]);

    return [
      "success" => true,
      "message" => "Logout"
    ];
  }

  public static function authOnReopen($request) {

    $token        = $request['token'];
		$user_refid   = $request['user_refid'];
		$device       = $request['device'];

    $auth = DB::table("user")
    ->where([
      ["reference_id", $token],
      ["user_refid", $user_refid],
      ["device_credential", $device],
      ["verified", "1"],
      ["status", "1"]
    ])
    ->get();

    if(count($auth) > 0) {
      return [
        "success" => true,
        "message" => "Authenticated"
      ];
    }
    else {
      return [
        "success" => false,
        "message" => "Unauthenticated"
      ];
    }

  }

  public static function verify($request) {

    $exist = DB::table("user")
    ->select("reference_id", "user_credential")
    ->where([
      ["reference_id", $request['token']],
      ["otp", $request['otp']],
      ["verified", "0"]
    ])
    ->get();

    if(count($exist) > 0) {
      $verified = DB::table("user")
      ->where([
        ["reference_id", $request['token']],
        ["otp", $request['otp']],
        ["verified", "0"]
      ])
      ->update([
        "verified"        => "1",
        "verified_date"   => date("Y-m-d h:i:s")
      ]);

      return [
        "success" => true,
        "reference_id"  => $exist[0]->reference_id,
        "credential"    => json_decode($exist[0]->user_credential)
      ];
    }
    else {
      return [
        "success" => false,
        "message" => "Incorrect OTP Code or expired"
      ];
    }
  }

  public static function auth($request) {

    $config             = Config::config();
    $table_users        = $config['table_users'];
    $table_auth         = $config['table_auth'];
    $fetch              = $config['fetch'];
    $incorrect_message  = $config['incorrect_message'];
    $enable_otp_sms     = $config['enable_otp_sms'];

    $user   = DB::table($table_users)
    ->select($fetch)
    ->where([
      ["email", $request['email']],
      ["password", $request['password']]
    ])
    ->get();

    if(count($user) > 0) {

      $tkn        = Config::token();
      $otp        = random_int(100000, 999999);
      $logged     = DB::table($table_auth)->insert([
        "reference_id"        => $tkn,
        "otp"                 => $otp,
        "verified"            => 0,
        "user_refid"          => $user[0]->reference_id,
        "user_credential"     => json_encode($user[0]),
        "device_credential"   => $request['device'],
        "date_login"          => date("Y-m-d h:i:s")
      ]);

      if($logged) {

        $otp_response = [];
      
        if($enable_otp_sms) {
          $user_mobile  = $user[0]->mobile;
          $user_name    = $user[0]->lastname . ' ' . $user[0]->firstname;
          $message      = "Your authentication OTP Code is " . $otp;
          $otp_response = \App\Http\Controllers\plugin_twilio_sms\Config::send($user_mobile, $user_name, $message);
        }
        else {
          $otp_response = [
            "success" => false,
            "message" => "Verification via SMS OTP Code is disabled"
          ];
        }

        if(Config::config()['enable_otp_sms']) {
          return [
            "success" => true,
            "otp"     => $otp,
            "token"   => $tkn,
            "sms"     => $otp_response
          ];
        }
        else {
          return [
            "success" => true,
            "user"    => $user[0],
            "otp"     => $otp,
            "token"   => $tkn,
            "sms"     => $otp_response
          ];
        }
      }
      else {
        return [
          "success" => false,
          "user"    => null,
          "otp"     => null,
          "token"   => null,
          "sms"     => null
        ];
      }
    }
    else {
      return [
        "success" => false,
        "message" => $incorrect_message
      ];
    }
  }

  public static function isTokenActive($token, $user_refid) {

    $authenticated = DB::table("user_authentication")
      ->where([
        ["status", "2"],
        ["user_refid", $user_refid],
        ["reference_id", $token]
      ])
      ->whereNull('date_logout')
      ->get();
    
      if(count($authenticated) > 0) {
        return true;
      }
      else {
        return false;
      }
  }

  public static function token() {
    $DATE   = date('m').date('d').date('Y').date('h').date('i').date('s');
    $CHAR   = str_shuffle("1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ");
    return "TKN-".$DATE."-".substr($CHAR, 0, 3);
  }
}
