<?php

namespace App\Http\Controllers\plugin_blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * api/plugin_blog/create?reference_id=reference_id&title=title&subject=subject&cover=cover&content=content&created_by=created_by
 * 
 */

class Create extends Controller
{
    public static function create(Request $request) {

        if(Create::isDataExist("reference_id", $request['reference_id']) > 0) {
            return [
                "success"   => false,
                "message"   => "Blog already posted"
            ];
        }
        else if(Create::isDataExist("title", $request['title']) > 0) {
            return [
                "success"   => false,
                "message"   => "Blog title already exist"
            ];
        }
        else {
            $created = DB::table("plugin_blog")->insert([
                "reference_id"  => $request['reference_id'],
                "title"         => $request['title'],
                "subject"       => $request['subject'],
                "cover"         => $request['cover'],
                "content"       => $request['content'],
                "created_by"    => $request['created_by'],
                "created_at"    => date("Y-m-d h:i:s")
            ]);

            if($created) {
                return [
                    "success"   => true,
                    "message"   => "Blog successfully created"
                ];
            }
            else {
                return [
                    "success"   => false,
                    "message"   => "Something went wrong, please try again later."
                ];
            }
        }
    }

    public static function isDataExist($column, $value) {
        return DB::table("plugin_blog")->where($column, $value)->count();
    }
}
