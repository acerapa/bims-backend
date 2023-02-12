<?php

namespace App\Http\Controllers\plugin_twilio_sms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/*




*/

class Send extends Controller
{
  public static function SMS(Request $request) {

    $mobile   = $request['mobile'];
    $message  = $request['message'];
    $name     = $request['name'];
    
    return \App\Http\Controllers\plugin_twilio_sms\Config::send($mobile, $name, $message);
    
  }
}
