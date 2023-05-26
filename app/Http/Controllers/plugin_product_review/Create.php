<?php

namespace App\Http\Controllers\plugin_product_review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * api/plugin_product_review/create?product_refid=PRD-0001&user_refid=USR-456&score=3&comment=ok%20KAAYU&photos=[]
 * 
 */

class Create extends Controller
{
    public static function create(Request $request) {

        $reference_id = \App\Http\Controllers\plugin_utility\CreateReferenceNo::create('plugin_product_review');
        
        $created = DB::table("plugin_product_review")->insert([
            "reference_id"      => $reference_id,
            "product_refid"     => $request['product_refid'],
            "user_refid"        => $request['user_refid'],
            "score"             => $request['score'],
            "comment"           => $request['comment'],
            "photos"            => $request['photos'],
        ]);

        if($created) {
            $summary = \App\Http\Controllers\plugin_product_review\Summary::get(0, $request['product_refid']);
            return [
                "success"       => true,
                "message"       => "Review successfully posted",
                "summary"       => $summary
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Unable to post review, please try again later."
            ];
        }
    }
}
