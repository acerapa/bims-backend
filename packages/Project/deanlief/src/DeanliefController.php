<?php

namespace Project\Deanlief;

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

    public static function variables() {
        return [
            "listing_property_aminities"    => [
                "form"  => [
                    [
                        "type"          => "checkbox",
                        "label"         => "Balcony",
                        "value"         => false,
                    ],
                    [
                        "type"          => "checkbox",
                        "label"         => "Terrace",
                        "value"         => false,
                    ],
                    [
                        "type"          => "checkbox",
                        "label"         => "Air Conditioning",
                        "value"         => false,
                    ],
                    [
                        "type"          => "checkbox",
                        "label"         => "Built-In Wardrobes",
                        "value"         => false,
                    ],
                    [
                        "type"          => "checkbox",
                        "label"         => "Swimming Pool",
                        "value"         => false,
                    ],
                    [
                        "type"          => "checkbox",
                        "label"         => "Garden",
                        "value"         => false,
                    ],
                    [
                        "type"          => "checkbox",
                        "label"         => "Parking Space",
                        "value"         => false,
                    ]
                ]
            ],
            "listing_property_type" => [
                [
                    "code"          => "APRT",
                    "label"         => "Apartment",
                    "enabled"       => true
                ],
                [
                    "code"          => "CNDM",
                    "label"         => "Condominium",
                    "enabled"       => true
                ],
                [
                    "code"          => "DPLX",
                    "label"         => "Duplex",
                    "enabled"       => true
                ],
                [
                    "code"          => "FRRT",
                    "label"         => "For Rent",
                    "enabled"       => true
                ],
                [
                    "code"          => "HSLT",
                    "label"         => "House and Lot",
                    "enabled"       => true
                ],
                [
                    "code"          => "LAND",
                    "label"         => "Land",
                    "enabled"       => true
                ],
                [
                    "code"          => "LTPJ",
                    "label"         => "Lot Only Projects",
                    "enabled"       => true
                ],
                [
                    "code"          => "OFSP",
                    "label"         => "Office Space",
                    "enabled"       => true
                ],
                [
                    "code"          => "TWHS",
                    "label"         => "Townhouse",
                    "enabled"       => true
                ],
                [
                    "code"          => "WRHS",
                    "label"         => "Warehouse",
                    "enabled"       => true
                ],
                [
                    "code"          => "VLLA",
                    "label"         => "Villa",
                    "enabled"       => true
                ]
            ],
            "listing_market"    => [
                "FRSL"         => "For Sale",
                "FRRT"         => "For Rent"
            ],
            "user_position" => [
                "RGSR"         => [
                    "label"         => "Regular User",
                    "enabled"       => true
                ],
                "PRDT"         => [
                    "label"         => "President",
                    "enabled"       => true
                ],
                "VCPR"         => [
                    "label"         => "Vice-President",
                    "enabled"       => true
                ],
                "SLPR"         => [
                    "label"         => "Sales person",
                    "enabled"       => true
                ],
                "BRKR"         => [
                    "label"         => "Real Estate Agent",
                    "enabled"       => true
                ],
                "MKOF"         => [
                    "label"         => "Marketing Offers",
                    "enabled"       => true
                ],
                "ITSP"         => [
                    "label"         => "Tech Support",
                    "enabled"       => true
                ]
            ]
        ];
    }
}
