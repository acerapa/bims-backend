<?php

namespace App\Http\Controllers\plugin_inquiry_web_form;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * api/plugin_inquiry_web_form/delete/INQ-03132023121252-SMK
 */

class Delete extends Controller
{
    public static function delete($inquiry_refid) {

        $header = DB::table("plugin_inquiry_web_form")->where("reference_id", $inquiry_refid)->delete();
        $child  = DB::table("plugin_inquiry_web_form_tagging")->where("inquiry_refid", $inquiry_refid)->delete();

        return [
            "success"   => true,
            "message"   => "Deleted successfully",
            "header"    => $header,
            "child"     => $child
        ];
    }
}
