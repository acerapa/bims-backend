<?php

namespace App\Http\Controllers\plugin_review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * api/plugin_review/getFilteredReview?tag_primary=PCK-12292022095617-EU8&sort_by=lowest_rated&page=1
 * 
 */

class GetFilteredReview extends Controller
{
    public static function get(Request $request) {
        $sort_by = $request['sort_by'];
        if($sort_by == 'recommended') {
            return DB::table("plugin_review")->where([["tag_primary", $request['tag_primary']],["score", "5"]])->paginate(10);
        }
        else if($sort_by == 'most_recent') {
            return DB::table("plugin_review")->where("tag_primary", $request['tag_primary'])->orderBy("created_at","desc")->paginate(10);
        }
        else if($sort_by == 'oldest') {
            return DB::table("plugin_review")->where("tag_primary", $request['tag_primary'])->orderBy("created_at","asc")->paginate(10);
        }
        else if($sort_by == 'highest_rated') {
            return DB::table("plugin_review")->where("tag_primary", $request['tag_primary'])->orderBy("score","desc")->paginate(10);
        }
        else if($sort_by == 'lowest_rated') {
            return DB::table("plugin_review")->where("tag_primary", $request['tag_primary'])->orderBy("score","asc")->paginate(10);
        }
        else {
            return DB::table("plugin_review")->where("tag_primary", $request['tag_primary '])->orderBy("dataid","desc")->paginate(10);
        }
    }
}
