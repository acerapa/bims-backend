<?php

namespace App\Http\Controllers\plugin_blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * api/plugin_blog/editDetails?reference_id=ss&title=title&subject=subject&content=content&updated_by=updated_by
 * 
 */

class Edit extends Controller
{
    public static function details(Request $request) {
        return DB::table("plugin_blog")
        ->where("reference_id", $request['reference_id'])
        ->update([
            "title"         => $request['title'],
            "subject"       => $request['subject'],
            "content"       => $request['content'],
            "updated_by"    => $request['updated_by'],
            "updated_at"    => date("Y-m-d h:i:s")
        ]);
    }   
}
