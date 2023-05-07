<?php

namespace App\Http\Controllers\plugin_json_data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

/**
 * Check if has JSON data [MINUTE] ago.
 * 
 * \App\Http\Controllers\plugin_json_data\Exist::JSONExist("foxcity_nation_wide/filename.json");
 * \App\Http\Controllers\plugin_json_data\Exist::exist($store_path, $menute);
 * 
 */

class Exist extends Controller
{
  public static function JSONExist($file_path) {
    $folder_data = "public/".$file_path;
    if (Storage::exists($folder_data)) {
      return true;
    }
    else {
      return false;
    }
  }

  public static function exist($filename, $menute) {
    $folder_data = "public/plugin_json_data/".$filename;
    if (Storage::exists($folder_data)) {
      $last_modified          = Storage::lastModified($folder_data);
      $current_date_time      = Carbon::now()->timestamp;
      $minute_difference      = ($current_date_time - $last_modified) / 60;
      
      if($minute_difference < $menute) {
        return true;
      }
      else {
        Storage::delete($folder_data);
        return false;
      }  
    }
    else {
      return false;
    }
  }
}
