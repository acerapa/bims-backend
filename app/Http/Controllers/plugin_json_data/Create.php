<?php

namespace App\Http\Controllers\plugin_json_data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

/**
 * 
 * \App\Http\Controllers\plugin_json_data\Create::create($store_path, $store_value);
 * 
 */

class Create extends Controller
{
  public static function create($store_path, $store_value ) {
        
    $folder_date = "public/plugin_json_data/";
    $folder_data = "public/plugin_json_data/".$store_path;
    
    if (!Storage::exists($folder_date)) {
      Storage::makeDirectory($folder_date);
    }

    if (!Storage::exists($folder_data)) {
      Storage::disk("public")->put("plugin_json_data/". $store_path, json_encode($store_value));
    }
  }
}
