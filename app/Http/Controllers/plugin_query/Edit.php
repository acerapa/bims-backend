<?php

namespace App\Http\Controllers\plugin_query;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*

var args = {
  table: 'user_login',
  where: [
    ['dataid','=','3']
  ],
  update: [
    {"status":"0"},
    {"reference_id":"xxxxx"},
    {"user_refid":"usr"}
    ]
  };
  
  $.get( domain + "api/plugin_query/editMultiple?" + $.param(args), function (response) {
		console.log(response);
	});

*/

class Edit extends Controller
{
  public static function editMultiple(Request $request) {

    $editColumn         = $request['update'];
    $counts             = count($editColumn);
    $valuePerQuery      = 1 / $counts;
    $score              = 0;
    
    for($i = 0; $i < $counts; $i++) {
      $updated = DB::table($request["table"])->where($request["where"])->update($editColumn[$i]);
      if($updated) {
        $score = $score + $valuePerQuery;
      }
    }
    if($score > 0) {
      return [
        "success" => true,
        "score"   => $score,
        "message" => "Successfully updated"
      ];
    }
    else {
      return [
        "success" => false,
        "score"   => $score,
        "message" => "No changed applied"
      ];
    }
  }
}
