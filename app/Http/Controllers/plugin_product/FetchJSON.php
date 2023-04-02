<?php

namespace App\Http\Controllers\plugin_product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FetchJSON extends Controller
{
    public static function jsonFetch($product_refid) {
        /**
         * Get product data from JSON File
         * 1. Details
         * 2. Photo
         * 3. Price variants
         */
    }

    public static function jsonLocalized($product_refid) {
        /**
         * 1. Create a json file of the product profile
         * 2. Update JSON file for all update made in the product
         * 
         */
    }
}
