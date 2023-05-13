<?php

namespace App\Http\Controllers\plugin_product_addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * 
 */

class Delete extends Controller
{
    public static function delete() {

        $table = "plugin_product_addons";
        $where = ["reference_id" => "PAO-05112023033205-BPO"];

        return \App\Http\Controllers\plugin_delete_recyclable\Delete::delete($table, $where, "Jason");
    }
}
