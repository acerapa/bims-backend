<?php

namespace App\Http\Controllers\plugin_review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 
 * api/plugin_review/calculate?tag_refid=PCK-02232023083857-JMR&table=package&whereClm=reference_id&whereVal=PCK-02232023083857-JMR
 * 
 */

class ScoreCalculator extends Controller
{
    public static function calculate(Request $request) {
        $summary = DB::table("plugin_review")
        ->join("plugin_review_tagging","plugin_review.reference_id","=","plugin_review_tagging.review_refid")
        ->select(
            "plugin_review.dataid",
            "plugin_review.reference_id",
            "plugin_review.score"
            )
        ->where("plugin_review_tagging.tag_refid","=", $request['tag_refid'])
        ->orderBy("plugin_review.dataid","DESC")
        ->distinct("plugin_review.dataid")
        ->get();

        if(count($summary) > 0) {

            $sum        = 0;
            $count      = count($summary);
            $score      = 0;

            foreach($summary as $review) {
                $sum = $sum + $review->score;
            }

            $score      = $sum / $count;

            /** Update the separate table to hold review summary */
            $updated = DB::table($request["table"])
            ->where($request["whereClm"], $request['whereVal'])
            ->update([
                "review_score"  => $score,
                "review_total"  => $count
            ]);

            return [
                "sum"       => $sum,
                "count"     => $count,
                "score"     => $score,
                "rounded"   => round($score, 2),
                "updated"   => $updated
            ];
        }
        else {
            return [
                "sum"       => 0,
                "count"     => 0,
                "score"     => 0,
                "rounded"   => 0,
                "updated"   => false
            ];
        }
    }
}
