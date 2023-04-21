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
        try {
            return [
                "success"   => true,
                "message"   => "Converted successfully",
                "algo"      => $algo,
                "string"    => $string,
                "result"    => hash($algo, $string)
            ];
        }
        catch (Exception $e) {
            return [
                "success"   => false,
                "message"   => $e->getMessage(),
                "algo"      => $algo,
                "string"    => $string,
                "result"    => null
            ];
        }
    }
}
