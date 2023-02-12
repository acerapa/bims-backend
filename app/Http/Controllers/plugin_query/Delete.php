<?php

namespace App\Http\Controllers\plugin_query;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*

var args = {
  table: 'user_login',
  where: [
    ['dataid','=','1']
  ]
};

$.get( domain + "api/plugin_query/deletePermanent?" + $.param(args), function (response) {
  console.log(response);
});

*/

class Delete extends Controller
{
  public static function deletePermanent(Request $request) {
    $deleted = DB::table($request["table"])
    ->where($request["where"])
    ->delete();

    if($deleted) {
      return [
        "success"   => true,
        "message"   => "Successfully deleted"
    ];
    }
    else {
      return [
        "success"   => false,
        "message"   => "Unable to delete"
      ];
    }
  }
}
