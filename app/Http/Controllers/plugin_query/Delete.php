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


var args = {
  table: 'user_login',
  where: [
    ['dataid','=','1']
  ],
  user_refid: '',
  password: ''
};

$.get( domain + "api/plugin_query/deleteWithPassword?" + $.param(args), function (response) {
  console.log(response);
});

*/

class Delete extends Controller
{
  public static function deletePermanent(Request $request) {
    Delete::recycleBin($request["table"], $request["where"], '');
    $deleted = DB::table($request["table"])->where($request["where"])->delete();
    if($deleted) {
      return [ "success" => true, "message" => "Successfully deleted" ];
    }
    else {
      return [ "success" => false, "message" => "Unable to delete" ];
    }
  }

  public static function deleteWithPassword(Request $request) {

    $user_refid = $request['user_refid'];
    $password   = $request['password'];
    $isCorrect  = DB::table("plugin_user")->where([["reference_id", $user_refid],["password", $password],])->count();

    if($isCorrect > 0) {
      Delete::recycleBin($request["table"], $request["where"], $user_refid);
      $deleted = DB::table($request["table"])->where($request["where"])->delete();
      if($deleted) {
        return [ "success" => true, "message" => "Successfully deleted" ];
      }
      else {
        return [ "success" => false, "message" => "Unable to delete" ];
      }
    }
    else {
      return [
        "success" => false,
        "message" => "Password is incorrect"
      ];
    }
  }

  public static function recycleBin($table, $whereArray, $deleted_by) {
    $data = DB::table($table)->where($whereArray)->get();
    if(count($data) > 0) {
      return DB::table("plugin_recycle_bin")->insert([
        "table_src"     => $table,
        "where_src"     => json_encode($whereArray),
        "data_object"   => json_encode($data),
        "deleted_date"  => date("Y-m-d h:i:s"),
        "deleted_by"    => $deleted_by
      ]);
    }
    else {
      return true;
    }
  }
}
