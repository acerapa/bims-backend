<?php

namespace App\Http\Controllers\plugin_twilio_sms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Twilio;

/************************************************
  Documentations
*************************************************
  Twilio Laravel Documentation:
  1: https://www.twilio.com/blog/create-sms-portal-laravel-php-twilio

  ISO Country Code reference
  1: https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2#Officially_assigned_code_elements

  Twilio Set-up procedures:
  1: Install SDK composer require twilio/sdk
  2: Get your twilio account_sid and auth_token
  
  Validation and returns
  1: HTTP 404 status code - Return if number is invalid
  2: E.164 FORMAT - Accepted National Number format

  Inline Call
  1: \App\Http\Controllers\plugin_twilio_sms\Config::settings();
  2: \App\Http\Controllers\plugin_twilio_sms\Config::send($mobile, $name, $message);

*/

class Config extends Controller
{
  public static function settings() {
    return [
      "enable"        => true,
      "account_sid"   => "AC9bb7f744e4ffdc515a4a4c77cb7e4c62",
      "auth_token"    => "d174fc42fe03a5e297f93ee435bb23ee",
      "sender_number" => "+14092456018",
      "table"         => "sms_logs"
    ];
  }

  public static function send($mobile, $name, $message_body) {

    $config         = Config::settings();
    $enable         = $config['enable'];
    $account_sid    = $config['account_sid'];
    $auth_token     = $config['auth_token'];
    $sender_number  = $config['sender_number'];
    $table          = $config['table'];

    if($mobile == '') {
      return [
        "success" => false,
        "message" => "Mobile number is required."
      ];
    }
    else if($message_body == '') {
      return [
        "success" => false,
        "message" => "Message body is required."
      ];
    }
    else {

      try {

        if($enable) {
          $client         = new Twilio\Rest\Client($account_sid, $auth_token);
          $message        = $client->messages->create(
            '+'.$mobile, [
              'from' => $sender_number,
              'body' => $message_body
              ]
            );
        }

        DB::table($table)
        ->insert([
          "sender_number"     => $sender_number,
          "sender_name"       => "System",
          "recepient_number"  => $mobile,
          "recepient_name"    => $name,
          "message"           => $message_body
        ]);

        return [
          "success" => true,
          "message" => "Message sent"
        ];
      }
      catch (\Exception $e) {
        return [
          "success"     => false,
          "status_code" => $e->getCode(),
          "message"     => $e->getMessage()
        ];
      }
    }
  }
}
