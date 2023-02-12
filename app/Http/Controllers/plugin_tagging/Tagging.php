<?php

namespace App\Http\Controllers\plugin_tagging;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/*

\App\Http\Controllers\plugin_tagging\Config::isTagExist($type, $primary, $secondary, $created_by);
\App\Http\Controllers\plugin_tagging\Config::createTagging($type, $primary, $secondary, $created_by);
\App\Http\Controllers\plugin_tagging\Config::deleteTagging($type, $primary, $secondary, $created_by);

plugin_tagging/action/create/TEST/primary/secondary/jason
plugin_tagging/action/is_exist/TEST/primary/secondary/jason
plugin_tagging/action/delete/TEST/primary/secondary/jason

*/

class Tagging extends Controller
{
  public static function action($action, $type, $primary, $secondary, $created_by) {

    if($action == 'create') {
      return \App\Http\Controllers\plugin_tagging\Config::create($type, $primary, $secondary, $created_by);
    }
    else if($action == 'is_exist') {
      return \App\Http\Controllers\plugin_tagging\Config::isExist($type, $primary, $secondary, $created_by);
    }
    else if($action == 'delete') {
      return \App\Http\Controllers\plugin_tagging\Config::delete($type, $primary, $secondary, $created_by);
    }
    else {
      return [
        "success"   => false,
        "message"   => "Invalid action"
      ];
    }
  }
}
