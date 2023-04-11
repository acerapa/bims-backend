<?php

namespace App\Http\Controllers\plugin_query;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**************************************************
PLUGIN USAGE
***************************************************
  var args = {
    table: 'user',
    column: {
      first_name: 'Mark',
      last_name: 'Zuckerberg',
      status: 1
    }
  };
  
  $.get( domain + "plugin_query/insertGetId?" + $.param(args), function (response) {
    console.log(response);
  });

*/

class Create extends Controller
{
  public static function insertGetId(Request $request) {

    $data = DB::table($request["table"])->insertGetId($request['column']);
    
    if($data) {
        return [
            "success"   => true,
            "message"   => "Inserted successfully.",
            "dataid"    => $data
        ];
    }
    else {
        return [
            "success"   => false,
            "message"   => "Insertion not successful.",
            "dataid"    => null
        ];
    }
  }
}
