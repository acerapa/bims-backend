<?php

namespace App\Http\Controllers\plugin_conversion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * api/plugin_conversion/string_to_base64_decode/VGhpcyBpcyBhbiBlbmNvZGVkIHN0cmluZw==
 */

class StringToBase64Decode extends Controller
{
    public static function decode($string) {
        return base64_decode($string, false);
    }
}
