<?php

namespace App\Http\Controllers\plugin_review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScoreCalculator extends Controller
{
    public static function calculate($tag_primary) {
        $summary = DB::table("plugin_review")->select("reference_id","score")->where("tag_primary", $tag_primary)->get();
        return $summary;
    }
}
