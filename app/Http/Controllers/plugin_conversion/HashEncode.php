<?php

namespace App\Http\Controllers\plugin_conversion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Supported algo:
 * [md5]
 * 
 */

class HashEncode extends Controller
{
    public static function hash_algos() {
        return hash_algos();
    }

    public static function encode($algo, $string) {
        return hash('md5', $string);
    }
}
