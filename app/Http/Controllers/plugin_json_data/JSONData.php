<?php

namespace App\Http\Controllers\plugin_json_data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/*************************************************
 *    How to use:
 *************************************************
 *    1: Get JSON data call: 
 *      \App\Http\Controllers\plugin_json_data\JSONData::get($filename);
 * 
 *    2: Create JSON data call:
 *      \App\Http\Controllers\plugin_json_data\JSONData::create($filename, $data);
 * 
 *    3: Check is JSON data exist a minute ago call:
 *      \App\Http\Controllers\plugin_json_data\JSONData::exist($filename, $menute_ago);
 *      ~ It check if data exist best of minute provided
 *      ~ It deleted expired json data
 * 
 */

class JSONData extends Controller
{
  public static function get($filename) {
    return \App\Http\Controllers\plugin_json_data\Get::get($filename);
  }

  public static function create($filename, $data) {
    \App\Http\Controllers\plugin_json_data\Create::create($filename, $data);
  }

  public static function exist($filename, $menute_ago) {
    return \App\Http\Controllers\plugin_json_data\Exist::exist($filename, $menute_ago);
  }

  public static function delete() {
    //
  }
}
