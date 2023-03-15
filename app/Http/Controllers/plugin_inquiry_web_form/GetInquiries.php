<?php

namespace App\Http\Controllers\plugin_inquiry_web_form;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * api/plugin_inquiry_web_form/getInquiries?tag_refid=USR-02012023111223-HR4&rowPerPage=3&orderbyClm=dataid&orderbySort=desc
 * 
 */

class GetInquiries extends Controller
{
    public static function get(Request $request) {
        return DB::table("plugin_inquiry_web_form")
        ->join("plugin_inquiry_web_form_tagging","plugin_inquiry_web_form.reference_id","=","plugin_inquiry_web_form_tagging.inquiry_refid")
        ->select(
            "plugin_inquiry_web_form.*",
            "plugin_inquiry_web_form_tagging.seen_at",
            "plugin_inquiry_web_form_tagging.status as tag_status"
        )
        ->where("tag_refid", $request['tag_refid'])
        ->distinct("plugin_inquiry_web_form.dataid")
        ->orderBy($request['orderbyClm'], $request['orderbySort'])
        ->paginate($request['rowPerPage']);
    }
}
