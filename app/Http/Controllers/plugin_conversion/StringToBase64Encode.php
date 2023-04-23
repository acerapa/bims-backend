<?php

namespace App\Http\Controllers\plugin_conversion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * api/plugin_conversion/string_to_base64_encode/This%20is%20an%20encoded%20string
 * 
 */

class StringToBase64Encode extends Controller
{
    public static function encode($string) {
        try {
            return [
                "success"   => true,
                "message"   => "Converted successfully",
                "string"    => $string,
                "result"    => base64_encode($string)
            ];
        }
        catch (Exception $e) {
            return [
                "success"   => false,
                "message"   => $e->getMessage(),
                "string"    => $string,
                "result"    => null
            ];
        }
    }
}
