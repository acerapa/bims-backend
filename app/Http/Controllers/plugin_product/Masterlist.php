<?php

namespace App\Http\Controllers\plugin_product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**********************************************************************************************************
 *      Save JSON File for page 1 only
 **********************************************************************************************************
 *      \App\Http\Controllers\plugin_product\Masterlist::byStoreMethod(["json_file" => "0","store_refid" => $store_refid,"page" => 1])
 *      plugin_product/masterlistByStore?json_file=0&store_refid=STR-05042023044205-QEN&page=2
 */

class Masterlist extends Controller
{
    public static function byStore(Request $request) {
        return Masterlist::byStoreMethod($request);   
    }

    public static function byStoreMethod($request) {

        $store_refid    = $request['store_refid'];
        $page           = $request['page'];
        $json_file      = $request['json_file'];
        
        return DB::table("plugin_product")
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
            
            $data_list = $source['data'];
            
            $temp = [];
            foreach($data_list as $item) {
                $temp[] = [
                    "header"    => $item,
                    "photos"    => \App\Http\Controllers\plugin_product\ProductProfile::photos(1, $item->product_refid),
                    "stock"     => \App\Http\Controllers\plugin_product\ProductProfile::stock(1, $item->product_refid),
                    "pricing"   => \App\Http\Controllers\plugin_product\ProductProfile::pricing(1, $item->product_refid),
                    "sold"      => \App\Http\Controllers\plugin_product\ProductProfile::sold(1, $item->product_refid),
                ];
            }

            return [
                "current_page"      => $source['current_page'],
                "last_page"         => $source['last_page'],
                "from"              => $source['from'],
                "to"                => $source['to'],
                "per_page"          => $source['per_page'],
                "total"             => $source['total'],
                "data"              => $temp,
                "hostlink"          => env("FTP_SERVER_HOSTLINK_1")
            ];
    }
}
