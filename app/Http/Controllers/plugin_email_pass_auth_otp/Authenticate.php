<?php

namespace App\Http\Controllers\plugin_email_pass_auth_otp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/*

api/plugin_email_pass_auth_otp/authenticate?email=jasonlipreso@gmail.com&password=rylle161710&device=test
api/plugin_email_pass_auth_otp/verifyOTP?token=TKN-01062023054921-RSD&otp=168432
api/plugin_email_pass_auth_otp/authOnReopen?token=TKN-01062023081027-T0K0&user_refid=USR-12302022065909-VWP&device=Mozilla-xxx
api/plugin_email_pass_auth_otp/authLogout/TKN-01062023075839-ZR3

*/

class Authenticate extends Controller
{
  public static function authBasic($email, $password) {
    return \App\Http\Controllers\plugin_email_pass_auth_otp\Config::authBasic($email, $password);
  }

  public static function auth(Request $request) {
    return \App\Http\Controllers\plugin_email_pass_auth_otp\Config::auth($request);
  }

  public static function verifyOTP(Request $request) {
    return \App\Http\Controllers\plugin_email_pass_auth_otp\Config::verify($request);
  }

  public static function authOnReopen(Request $request) {
    return \App\Http\Controllers\plugin_email_pass_auth_otp\Config::authOnReopen($request);
  }

  public static function authLogout($token) {
    return \App\Http\Controllers\plugin_email_pass_auth_otp\Config::authLogout($token);
  }
}
