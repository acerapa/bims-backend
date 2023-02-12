<?php

namespace App\Http\Controllers\plugin_json_data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

/**
 * 
 * \App\Http\Controllers\plugin_json_data\Get::get($store_path);
 * 
 */

class Get extends Controller
{
  public static function get($store_path) {
    $folder_data = "public/plugin_json_data/".$store_path;
    if (Storage::exists($folder_data)) {
      $path = storage_path("app/".$folder_data);
      return json_decode(file_get_contents($path), true);
    }
    else {
      return null;
    }
  }
}
