<?php

namespace App\Http\Controllers\plugin_blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * 
 * \App\Http\Controllers\plugin_blog\Config::config();
 * 
 * Collation Used: utf8mb4_general_ci
 * 
 */

class Config extends Controller
{
    public static function config() {
        return [
            "table_blog"        => "plugin_blog",
            "table_user"        => "plugin_user",
            "table_user_fetch"  => ["reference_id","firstname","lastname","mobile","email","photo"]
        ];
    }
}
