<?php

namespace Project\Foxcity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * foxcity/init
 * 
 */

class Init extends Controller
{
    public static function fetch() {
        return [
            "global_banner"     => \App\Http\Controllers\plugin_banner\Fetch::get(),
            "global_category"   => \App\Http\Controllers\plugin_product_category_global\Fetch::all(),
            "recomended_store"  => null,
            "popular_product"   => null,
            "notification"      => null,
            "message"           => null
        ];
    }
}
