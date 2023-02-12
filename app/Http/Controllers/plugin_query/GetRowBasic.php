<?php

namespace App\Http\Controllers\plugin_query;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*

api/plugin_query/getRowBasic/user/all/dataid/1
api/plugin_query/getRowBasic/user/dataid,first_name,last_name,mobile/dataid/1

*/

class GetRowBasic extends Controller
{
  public static function get($table, $getColumn, $whereColumn, $whereValue) {
    if($getColumn == "all") {
      return DB::table($table)
      ->where($whereColumn, $whereValue)
      ->get();
    }
    else {
      $column_list =  explode(',', $getColumn);
      return DB::table($table)
      ->select($column_list)
      ->where($whereColumn, $whereValue)
      ->get();
    }
  }
}
