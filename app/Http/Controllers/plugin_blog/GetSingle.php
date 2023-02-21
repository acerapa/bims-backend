<?php

namespace App\Http\Controllers\plugin_blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * This plugin uses the following plugin
 * - plugin_photo: For tagging blog photos
 * 
 * api/plugin_blog/getSingle?blog_refid=BLG-02212023020110-45Z
 * 
 */

class GetSingle extends Controller
{
    public static function get(Request $request) {
        $blog = DB::table("plugin_blog")
        ->select("reference_id","title","subject","cover","content","created_by","created_at","status")
        ->where("reference_id", $request['blog_refid'])
        ->get();

        if(count($blog) > 0) {
            return [
                "success"       => true,
                "message"       => "Blog fetched successfully",
                "blog_header"   => $blog[0],
                "blog_tagging"  => \App\Http\Controllers\plugin_query\GetRowBasic::get("plugin_blog_tagging", "dataid,tag_refid,tag_type", "blog_refid", $request['blog_refid']),
                "blog_photos"   => \App\Http\Controllers\plugin_query\GetRowBasic::get("plugin_photo_tagging", "all", "tagged", $request['blog_refid']),
            ];
        }
        else {
            return [
                "success"       => false,
                "message"       => "Blog details not found"
            ];
        }
    }
}
