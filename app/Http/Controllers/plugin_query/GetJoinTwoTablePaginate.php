<?php

namespace App\Http\Controllers\plugin_query;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*

var args = {
  table_pri: 'user_distributor',
 	table_sec: 'user',
 	join_pri: 'user_distributor.user_refid',
 	join_sec: 'user.reference_id',
 	getClm: [
    "user_distributor.reference_id as account_refid",
 		"user_distributor.user_refid",
 		"user.last_name",
 		"user.first_name",
 		"user.email"
 	],
 	where: [
 		["user.reference_id","=","USR-09272022115021-XQ8"],
 		["user_distributor.status","=","1"]
 	],
  orderbyClm: "user_distributor.dataid",
	orderbySort: "DESC",
  page: 1,
  rowPerPage: 10
}

$.get( domain + "api/plugin_query/getJoinTwoTablePaginate?" + $.param(args), function (response) {
  console.log(response);
});

*/

class GetJoinTwoTablePaginate extends Controller
{
    public static function get(Request $request) {
      return DB::table($request['table_pri'])
      ->select($request['getClm'])
      ->join($request['table_sec'], $request['join_pri'],"=", $request['join_sec'])
      ->where($request['where'])
      ->orderBy($request['orderbyClm'], $request['orderbySort'])
      ->paginate($request['rowPerPage']);
    }
}
