<?php

namespace App\Http\Controllers\plugin_project_config;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * This file create error.txt file to log website errors
 */

class BugTextLog extends Controller
{
    public static function log() {
        return true;
    }
}
