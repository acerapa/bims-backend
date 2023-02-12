<?php

namespace App\Http\Controllers\plugin_inquiry;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Inquiry extends Controller
{
  public static function postInquiry(Request $request) {
    return \App\Http\Controllers\plugin_inquiry\Config::postInquiry($request);
  }
}
