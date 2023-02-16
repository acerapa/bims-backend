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
  public static function create(Request $request) {
    $created = DB::table("plugin_review")->insert([
      "reference_id"    => $request["reference_id"],
      "name"            => $request["name"],
      "photo"           => $request["photo"],
      "score"           => $request["score"],
      "hightlight"      => $request["hightlight"],
      "comment"         => $request["comment"]
    ]);

    if($created) {
      $tagging = $request['taglist'];
      if(count($tagging) > 0) {
        foreach($tagging as $tag) {
          DB::table("plugin_review_tagging")->insert($tag);
        }
      }
      else {

      }
    }
    else {

    }
  }
}
