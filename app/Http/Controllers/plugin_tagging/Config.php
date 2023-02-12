<?php

namespace App\Http\Controllers\plugin_tagging;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Config extends Controller
{
  public static function config() {
    return [];
  }

  public static function isExist($type, $primary, $secondary, $created_by) {
    $isTagExist = DB::table("tagging")
    ->where([
      ["type", $type],
      ["primary", $primary],
      ["secondary", $secondary]
    ])
    ->get();

    if(count($isTagExist) > 0) {
      return true;
    }
    else {
      return false;
    }
  }

  public static function create($type, $primary, $secondary, $created_by) {
    
    $create = DB::table("tagging")->insert([
      "type"          => $type,
      "primary"       => $primary,
      "secondary"     => $secondary,
      "created_at"    => date("Y-m-d h:i:s"),
      "created_by"    => $created_by
    ]);

    if($create) {
      return [
        "success"   => true,
        "message"   => "Tagging created"
      ];
    }
    else {
      return [
        "success"   => false,
        "message"   => "Tagging denied"
      ];
    }

  }

  public static function delete($type, $primary, $secondary, $created_by) {
    $deleted = DB::table("tagging")
    ->where([
      ["type", $type],
      ["primary", $primary],
      ["secondary", $secondary]
    ])
    ->delete();

    if($deleted) {
      return [
        "success"   => true,
        "message"   => "Tagging deleted"
      ];
    }
    else {
      return [
        "success"   => false,
        "message"   => "Tagging deletion denied"
      ];
    }
  }
}
