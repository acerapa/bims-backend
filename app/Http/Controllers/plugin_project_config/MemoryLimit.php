<?php

namespace App\Http\Controllers\plugin_project_config;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * \App\Http\Controllers\plugin_project_config\MemoryLimit::set();
 */

class MemoryLimit extends Controller
{
    public static function set() {
        ini_set('memory_limit','800M');
    }
}
