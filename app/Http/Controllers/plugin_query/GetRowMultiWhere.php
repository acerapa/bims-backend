<?php

namespace App\Http\Controllers\plugin_query;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*

var args = {
  table: "user",
  getClm: 'all',
  where: [
    ["status","1"]
  ],
  orderByClm: 'dataid',
  orderBySort: 'DESC'
};

$.get( domain + "api/plugin_query/getRowPaginate?" + $.param(args), function (response) {
  console.log(response);
});

*/

class GetRowMultiWhere extends Controller
{
  public static function get(Request $request) {
    if($request['getClm'] == "all") {
      return DB::table($request['table'])
      ->where($request['where'])
      ->orderBy($request['orderByClm'], $request['orderBySort'])
      ->get();
    }
    else {
      $column_list =  explode(',', $getColumn);
      return DB::table($table)
      ->select($column_list)
      ->where($request['where'])
      ->orderBy($request['orderByClm'], $request['orderBySort'])
      ->get();
    }
  }
}
