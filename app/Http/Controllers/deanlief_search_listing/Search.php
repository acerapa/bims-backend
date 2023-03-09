<?php

namespace App\Http\Controllers\deanlief_search_listing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * api/deanlief_search_listing/search?pro_type=all&city_code=all&market=all&page=1
 * 
 */

class Search extends Controller
{
    public static function search(Request $request) {

        $property_type  = $request['pro_type'];
        $city_code      = $request['city_code'];
        $market         = $request['market'];

        if($property_type == 'all') {
            $property_type = ["property_type","!=", null];
        }
        else {
            $property_type = ["property_type","=", $request['pro_type']];
        }

        if($city_code == 'all') {
            $city_code = ["city_code","!=", null];
        }
        else {
            $city_code = ["city_code","=", $request['city_code']];
        }

        if($market == 'all') {
            $market = ["market","!=", null];
        }
        else {
            $market = ["market","=", $request['market']];
        }

        return DB::table("listing")
        ->where([$market, $property_type, $city_code])
        ->paginate(12);
    }
}
