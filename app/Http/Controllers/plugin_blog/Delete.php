<?php

namespace App\Http\Controllers\plugin_blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * api/plugin_blog/delete/blog_refid
 * 
 */

class Delete extends Controller
{
    public static function delete($blog_refid) {

        $plugin_blog                = DB::table("plugin_blog")->where('reference_id', $blog_refid)->delete();
        $plugin_blog_tagging        = DB::table("plugin_blog_tagging")->where('blog_refid', $blog_refid)->delete();
        $plugin_photo               = DB::table("plugin_photo")->where('tagged', $blog_refid)->delete();
        $plugin_photo_tagging       = DB::table("plugin_photo_tagging")->where('tagged', $blog_refid)->delete();

        return [
            "success"               => true,
            "plugin_blog"           => $plugin_blog,
            "plugin_blog_tagging"   => $plugin_blog_tagging,
            "plugin_photo"          => $plugin_photo,
            "plugin_photo_tagging"  => $plugin_photo_tagging,
        ];
    }
}
