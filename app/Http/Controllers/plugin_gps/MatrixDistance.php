<?php

namespace App\Http\Controllers\plugin_gps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Description: Calculate distance from point A to B
 * 
 * plugin_gps/getDistance/11.173259194540984,123.73126137252197/11.1999448,123.740596
 * \App\Http\Controllers\plugin_gps\MatrixDistance::getDistance($origins, $destinations);
 * 
 * plugin_gps/placesAutoComplete/Apid
 * 
 * plugin_gps/geocode/ChIJHzCVPU1xqTMRhz9MUw94M0o
 * 
 */

class MatrixDistance extends Controller
{
    public static function getDistance($origins, $destinations) {
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . $origins . "&destinations=" . $destinations . "&key=" . env("GOOGLE_MAP_API_KEY");
        return json_decode(file_get_contents($url), true);
    }

    public static function placesAutoComplete($keyword) {
        $url = "https://maps.googleapis.com/maps/api/place/queryautocomplete/json?input=" . $keyword . "&language=en&key=" . env("GOOGLE_MAP_API_KEY");
        return json_decode(file_get_contents($url), true);
    }

    public static function geocode($place_id) {
        $url = "https://maps.googleapis.com/maps/api/geocode/json?place_id=" . $place_id . "&key=" . env("GOOGLE_MAP_API_KEY");
        return json_decode(file_get_contents($url), true);
    }
}
