<?php

namespace App\Http\Controllers\plugin_product_review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * \App\Http\Controllers\plugin_product_review\Fetch::method(['json_file' => $json_file, 'product_refid' => $product_refid, 'order_by' => 'most_recent', 'page'=>1]);
 * plugin_product_review/fetch?product_refid=PRD-0001&order_by=[most_recent,recommended,highest,lowest]&page=1
 */

class Fetch extends Controller
{
    public static function fetch(Request $request) {
        return Fetch::method($request);
    }

    public static function method($request) {
        
        $paginate       = 12;
        $product_refid  = $request['product_refid'];
        $orderBy        = $request['order_by'];
        $json_file      = $request['json_file'];

        $file_path      = "plugin_product_review/" . $product_refid ."-page-1.json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if(($json_exist) && ($json_file == '1')) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {

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
                    "photos"        => \App\Http\Controllers\plugin_photo\Fetch::getByTagged($json_file, $item->reference_id),
                    "user_profile"  => \App\Http\Controllers\plugin_user\GetProfile::header($json_file, $item->user_refid),
                    "likes"         => [
                        "liked"         => false,
                        "likes"         => rand(1, 500)
                    ]
                ];
            }

            $data_json = [
                "current_page"      => $data['current_page'],
                "last_page"         => $data['last_page'],
                "from"              => $data['from'],
                "to"                => $data['to'],
                "per_page"          => $data['per_page'],
                "total"             => $data['total'],
                "data"              => $temp,
                "hostlink"          => env("FTP_SERVER_HOSTLINK_1")
            ];

            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data_json);
            return $data_json;
        }
    }
}
