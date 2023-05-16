<?php

namespace App\Http\Controllers\plugin_product_review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * \App\Http\Controllers\plugin_product_review\Summary::get($memory_json, $product_refid);
 * 
 */

class Summary extends Controller
{
    public static function get($memory_json, $product_refid) {

        $file_path      = "plugin_product_review/summary/". $product_refid .".json";
        $json_exist     = \App\Http\Controllers\plugin_json_data\Exist::JSONExist($file_path);
        
        if(($json_exist) && ($memory_json == 1)) {
            return \App\Http\Controllers\plugin_json_data\Get::getJSON($file_path);
        }
        else {

            $score_sum          = Summary::score_sum($product_refid);
            $score_count        = Summary::score_count($product_refid);
            $score_result       = $score_sum / $score_count;
            $score_round_off    = round($score_result, 2, PHP_ROUND_HALF_UP);

            $data = [
                "score_sum"         => $score_sum,
                "total_reviews"     => $score_count,
                "score_result"      => $score_result,
                "score_round_off"   => $score_round_off
            ];
            \App\Http\Controllers\plugin_json_data\Create::createJSON($file_path, $data);
            return $data;
        }
    }

    public static function score_sum() {
        return DB::table("plugin_product_review")->sum("score");
    }

    public static function score_count() {
        return DB::table("plugin_product_review")->count();
    }
}
