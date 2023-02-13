<?php

namespace App\Http\Controllers\plugin_config;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;

/**
 * api/plugin_config/file/table-description
 * 
 * 
 * 
 */

class ConfigFile extends Controller
{
    public static function file($filepath) {
        return Config::get($filepath);
    }
}
