<?php

namespace App\Http\Controllers\plugin_product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_product/masterlistByStore?store_refid=STR-05042023044205-QEN&page=2
 */

class Masterlist extends Controller
{
    public static function byStore(Request $request) {
        $store_refid = $request['store_refid'];
        $data = DB::table("plugin_product")
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
            ["store_refid", $store_refid],
            ["status", 1]
        ])
        ->orderBy("name","ASC")
        ->paginate(10)->toArray();

        $data_list = $data['data'];
        
        $temp = [];
        foreach($data_list as $item) {
            $temp[] = [
                "header"    => $item,
                "photos"    => \App\Http\Controllers\plugin_product\ProductProfile::photos($item->product_refid),
                "stock"     => \App\Http\Controllers\plugin_product\ProductProfile::stock($item->product_refid),
                "pricing"   => \App\Http\Controllers\plugin_product\ProductProfile::pricing($item->product_refid),
                "sold"      => rand(0, 1000)
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
