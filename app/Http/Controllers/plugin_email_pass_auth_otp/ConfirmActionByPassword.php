<?php

namespace App\Http\Controllers\plugin_email_pass_auth_otp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*

plugin_email_pass_auth_otp/confirmActionByPassword?user_refid=USR-12302022065909-VWP&password=rylle161711

*/

class ConfirmActionByPassword extends Controller
{
  public static function confirm(Request $request) {
    $exist = DB::table("plugin_user")
    ->where([
      ["reference_id", $request['user_refid']],
      ["password", $request['password']]
    ])
    ->count();
    if($exist > 0) {
      return [
        "authenticated" => true,
        "datetime"      => date("Y-m-d h:i:s")
      ];
    }
    else {
      return [
        "authenticated" => false,
        "datetime"      => date("Y-m-d h:i:s")
      ];
    }
  }
}
