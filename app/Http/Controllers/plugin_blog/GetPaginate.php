<?php

namespace App\Http\Controllers\plugin_blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * api/plugin_blog/getPaginate?category_refid=BLC-02212023022902-XEQ&page=1
 * api/plugin_blog/getPaginate?category_refid=all&page=1
 * 
 */

class GetPaginate extends Controller
{
    public static function get(Request $request) {

        $config             = \App\Http\Controllers\plugin_blog\Config::config();

        if($request['category_refid'] == 'all') {
            return DB::table("plugin_blog")
            ->join("plugin_user","plugin_blog.created_by","=","plugin_user.reference_id")
            ->select(
                "plugin_blog.reference_id as blog_refid",
                "plugin_blog.title",
                "plugin_blog.subject",
                "plugin_blog.cover",
                "plugin_blog.content",
                "plugin_blog.created_by",
                "plugin_blog.created_at",
                "plugin_blog.status as blog_status",
                "plugin_blog.dataid as sorting",
                "plugin_user.firstname",
                "plugin_user.lastname"
            )
            ->where([
                ["plugin_blog.status","1"]
            ])
            ->orderBy("plugin_blog.dataid","desc")
            ->distinct("plugin_blog.reference_id")
            ->paginate(12);
        }
        else {
            return DB::table("plugin_blog")
            ->join("plugin_blog_tagging","plugin_blog.reference_id","=","plugin_blog_tagging.blog_refid")
            ->join("plugin_user","plugin_blog.created_by","=","plugin_user.reference_id")
            ->select(
                "plugin_blog.reference_id as blog_refid",
                "plugin_blog.title",
                "plugin_blog.subject",
                "plugin_blog.cover",
                "plugin_blog.content",
                "plugin_blog.created_by",
                "plugin_blog.created_at",
                "plugin_blog.status as blog_status",
                "plugin_blog.dataid as sorting",
                "plugin_user.firstname",
                "plugin_user.lastname"
            )
            ->where([
                ["plugin_blog.status","1"],
                ["plugin_blog_tagging.tag_refid", $request['category_refid']],
                ["plugin_blog_tagging.tag_type","BLG_BLC"]
            ])
            ->orderBy("plugin_blog.dataid","desc")
            ->distinct("plugin_blog.reference_id")
            ->paginate(12);
        }

        
    }
}
