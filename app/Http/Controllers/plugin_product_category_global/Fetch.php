<?php

namespace App\Http\Controllers\plugin_product_category_global;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * \App\Http\Controllers\plugin_product_category_global\Fetch::all();
 * 
 */

class Fetch extends Controller
{
    public static function all() {
        $data = DB::table("plugin_product_category_global")
        ->where("status","1")
        ->select("reference_id as category_refid","name","icon")
        ->orderBy("name","ASC")
        ->get();
        if(count($data) > 0) {
            $list = [];
            foreach($data as $category) {
                $list[] = [
                    "category_refid"    => $category->category_refid,
                    "name"              => $category->name,
                    "icon"              => json_decode($category->icon),
                    "subcategory"       => Fetch::subcategory($category->category_refid)
                ];
            }
            return $list;
        }
        else {
            return [];
        }
    }

    public static function subcategory($category_refid) {
        return DB::table("plugin_product_category_global_subcategories")
        ->select("reference_id as subcat_refid","name")
        ->where([
            ["category_refid", $category_refid],
            ["status","1"]
        ])
        ->orderBy("name","ASC")
        ->get();
    }
}
