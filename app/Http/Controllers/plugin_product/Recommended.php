<?php

namespace App\Http\Controllers\plugin_product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_product/allByRating?page=1
 * \App\Http\Controllers\plugin_product\Recommended::allByRatingMethod(["page" => 1]);
 */

class Recommended extends Controller
{
    public static function allByRating(Request $request) {
        return Recommended::allByRatingMethod($request);
    }

    public static function allByRatingMethod($request) {
        $data =  DB::table("plugin_product")
        ->select(
            "reference_id as product_refid",
            "store_refid",
            "store_SKU",
            "store_menu_refid",
            "name",
            "description",
            "category_global_refid",
            "subcategory_global_refid",
            "sharable",
            "available",
            "created_at",
            "created_by",
            "status")
        ->where([
            ["status", 1]
        ])
        ->orderBy("name","ASC")
        ->paginate(10)->toArray();

        $data_list = $data['data'];

        $temp = [];
        foreach($data_list as $item) {
            $temp[] = [
                "header"    => $item,
                "photos"    => \App\Http\Controllers\plugin_product\ProductProfile::photos(1, $item->product_refid),
                "stock"     => \App\Http\Controllers\plugin_product\ProductProfile::stock(1, $item->product_refid),
                "pricing"   => \App\Http\Controllers\plugin_product\ProductProfile::pricing(1, $item->product_refid),
                "sold"      => \App\Http\Controllers\plugin_product\ProductProfile::sold(1, $item->product_refid)
            ];
        }

        return [
            "current_page"      => $data['current_page'],
            "last_page"         => $data['last_page'],
            "from"              => $data['from'],
            "to"                => $data['to'],
            "per_page"          => $data['per_page'],
            "total"             => $data['total'],
            "data"              => $temp,
            "hostlink"          => env("FTP_SERVER_HOSTLINK_1")
        ];
    }
}
