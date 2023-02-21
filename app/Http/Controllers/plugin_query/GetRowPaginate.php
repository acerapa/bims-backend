<?php

namespace App\Http\Controllers\plugin_query;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*

var args = {
  table: "plugin_user",
  getClm: 'all',
  where: [
    ["status","1"]
  ],
  orderByClm: 'dataid',
  orderBySort: 'DESC',
  numOfRow: 3
};

$.get( domain + "api/plugin_query/getRowPaginate?" + $.param(args), function (response) {
  console.log(response);
});

*/

class GetRowPaginate extends Controller
{
  public static function get(Request $request) {
    if($request['getClm'] == "all") {
      return DB::table($request['table'])
      ->where($request['where'])
      ->orderBy($request['orderByClm'], $request['orderBySort'])
      ->paginate($request['numOfRow']);
    }
    else {
      $column_list =  explode(',', $request['getClm']);
      return DB::table($request['table'])
      ->select($column_list)
      ->where($request['where'])
      ->orderBy($request['orderByClm'], $request['orderBySort'])
      ->paginate($request['numOfRow']);
    }
  }
}
