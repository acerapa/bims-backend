<?php

namespace App\Http\Controllers\plugin_json_data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Delete extends Controller
{
  public static function delete($keyword) {
    
    $directory      = "public/plugin_json_data";
    if($keyword == 'all') {
      $files =   Storage::allFiles($directory);
      return Storage::delete($files);
    }
    else {

      $files          = Storage::allFiles($directory);
      $delete_log     = [];
      
      foreach($files as $key => $path) {
        if(str_starts_with(basename($path), $keyword)) {
          $deleted        = Storage::delete($path);
          $delete_log[]   = [
            "deleted"   => $deleted,
            "filepath"  => $path
          ];
        }
      }
      return $delete_log;
    }
  }
}
