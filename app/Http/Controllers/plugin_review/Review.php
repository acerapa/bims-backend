<?php

namespace App\Http\Controllers\plugin_review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * api/plugin_review/create?reference_id=reference_id&name=name&photo=photo&score=4&hightlight=hightlight&comment=comment
 * 
 */

class Review extends Controller
{
  public static function getScore($tag_primary) {
    
    $sum    = DB::table("plugin_review")->where("tag_primary", $tag_primary)->sum("score");
    $sum    = floatval($sum);
    $count  = DB::table("plugin_review")->where("tag_primary", $tag_primary)->count();

    if(($sum == 0) || ($count)) {
      $score = 0;
    }
    else {
      $score  = $sum / $count;
    }
    
    return [
      "sum"     => $sum,
      "count"   => $count,
      "score"   => round($score, 2)
    ];
  }

  public static function create(Request $request) {
    $created = DB::table("plugin_review")->insert([
      "reference_id"    => $request["reference_id"],
      "tag_primary"     => $request["tag_primary"],
      "name"            => $request["name"],
      "photo"           => $request["photo"],
      "score"           => $request["score"],
      "hightlight"      => $request["hightlight"],
      "comment"         => $request["comment"],
      "attachment"      => $request["attachment"],
      "other"           => $request["other"]
    ]);

    if($created) {
      $tagging    = json_decode($request['taglist']);
      $tag_rev    = [];
      if(count($tagging) > 0) {
        foreach($tagging as $tag) {
          $tagged = DB::table("plugin_review_tagging")->insert([
            "review_refid"  => $tag->review_refid,
            "tag_refid"     => $tag->tag_refid,
            "tag_type"      => $tag->tag_type
          ]);

          $tag_rev[] = [
            "tagged"        => $tagged,
            "tag_refid"     => $tag->tag_refid,
            "tag_type"      => $tag->tag_type
          ];
        }
        return [
          "success" => true,
          "message" => "Successfully posted",
          "tagging" => $tag_rev
        ];
      }
      else {
        return [
          "success" => true,
          "message" => "Successfully posted",
          "tagging" => []
        ];
      }
    }
    else {
      return [
        "success" => false,
        "message" => "Posting review unsuccessful",
        "tagging" => []
      ];
    }
  }
}
