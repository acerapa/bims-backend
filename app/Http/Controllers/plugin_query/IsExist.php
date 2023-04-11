<?php

namespace App\Http\Controllers\plugin_query;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*

var args = {
  table: "user_login",
  where: [
    ["dataid","=","4"]
  ]
};

$.get( domain + "api/plugin_query/isDataExist?" + $.param(args), function (response) {
  console.log(response);
});

\App\Http\Controllers\plugin_query\IsExist::isExist($table, $whereArray);
\App\Http\Controllers\plugin_query\IsExist::isExist("table", [['column','=','value']]);

*/

class IsExist extends Controller
{
  
  public static function exist(Request $request) {
    $count = DB::table($request["table"])
    ->where($request["where"])
    ->count();
    
    if($count >= 1) {
      return [
        "exist"         => true,
        "count"         => $count
      ];
    }
    else {
      return [
        "exist"         => false,
        "count"         => $count,
      ];
    }
  }

  public static function isExist($table, $where) {
    return DB::table($table)->where($where)->count();
  }

}
