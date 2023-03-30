<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DeanliefController extends Controller
{
    public static function delete_listing($listing_refid) {
        
        /* Delete Header */
        $header             = DB::table("listing")->where("reference_id", $listing_refid)->delete();
        $photo              = DB::table("plugin_photo")->where("tagged", $listing_refid)->delete();
        $photo_tag          = DB::table("plugin_photo_tagging")->where("tagged", $listing_refid)->delete();
        $inquiry_list       = DB::table("plugin_inquiry_web_form_tagging")->select("inquiry_refid")->where("tag_refid", $listing_refid)->distinct("inquiry_refid")->get();

        if(count($inquiry_list) > 0) {
            foreach($inquiry_list as $list) {
                DB::table("plugin_inquiry_web_form")->where("reference_id", $list->inquiry_refid)->delete();
                DB::table("plugin_inquiry_web_form_tagging")->where("inquiry_refid", $list->inquiry_refid)->delete();
            }
        }

        return [
            "header"                => $header,
            "photo"                 => $photo,
            "photo_tag"             => $photo_tag
        ];
    }

    public static function search_listing(Request $request) {

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
