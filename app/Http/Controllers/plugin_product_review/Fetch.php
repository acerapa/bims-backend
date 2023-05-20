<?php

namespace App\Http\Controllers\plugin_product_review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_product_review/fetch?product_refid=PRD-0001&order_by=[most_recent,recommended,highest,lowest]&page=1
 */

class Fetch extends Controller
{
    public static function fetch(Request $request) {

        $paginate       = 12;
        $product_refid  = $request['product_refid'];
        $orderBy        = $request['order_by']; // 

        if($orderBy == 'most_recent') {
            $data = DB::table("plugin_product_review")->where("product_refid", $product_refid)->orderBy("dataid","desc")->paginate($paginate)->toArray();
        }
        else if($orderBy == 'recommended') {
            $data = DB::table("plugin_product_review")->where(["product_refid", $product_refid],["score", 5])->orderBy("dataid","desc")->paginate($paginate)->toArray();
        }
        else if($orderBy == 'highest') {
            $data = DB::table("plugin_product_review")->where("product_refid", $product_refid)->orderBy("score","desc")->paginate($paginate)->toArray();
        }
        else if($orderBy == 'lowest') {
            $data = DB::table("plugin_product_review")->where("product_refid", $product_refid)->orderBy("score","asc")->paginate($paginate)->toArray();
        }
        else {
            $data = DB::table("plugin_product_review")->where("product_refid", $product_refid)->orderBy("dataid","desc")->paginate($paginate)->toArray();
        }

        $temp = [];

        foreach($data['data'] as $item) {
            $temp[] = [
                "header"        => $item,
                "user_profile"  => \App\Http\Controllers\plugin_user\GetProfile::header(1, $item->user_refid),
                "likes"         => [
                    "liked"         => false,
                    "likes"         => rand(1, 500)
                ]
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
