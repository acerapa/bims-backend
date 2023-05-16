<?php

namespace App\Http\Controllers\plugin_product_review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 
 * 
 */

class Create extends Controller
{
    public static function create() {
        $reference_id = \App\Http\Controllers\plugin_utility\CreateReferenceNo::create('IMG');
        return DB::table("plugin_product_review")->insert([
            "reference_id" => $reference_id
        ]);
    }
}
