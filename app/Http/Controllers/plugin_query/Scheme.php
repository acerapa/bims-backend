<?php

namespace App\Http\Controllers\plugin_query;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*

query/getTableSchema/user

*/

class Scheme extends Controller
{
  public static function getTableSchema($table) {
    $query = "SHOW COLUMNS FROM ".$table;
    return  DB::select($query);
  }
}
