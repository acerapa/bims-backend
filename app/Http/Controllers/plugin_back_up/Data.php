<?php

namespace App\Http\Controllers\plugin_back_up;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_back_up/table_list
 * plugin_back_up/table_data
 * 
 */

class Data extends Controller
{
    public static function table_data() {
        $list = Data::table_list();
        $data = [];
        for($i = 0; $i < count($list); $i++) {
            $data[] = [
                "table_name"    => $list[$i],
                "table_data"    => DB::table($list[$i])->get(),
                "table_date"    => date("Y-m-d h:i:s")
            ];
        }
        return $data;
    }

    public static function table_list() {
        $data = DB::select('SHOW TABLES');
        $list = [];
        foreach ($data as $table) {
            $list[] = head($table);
        }
        return $list;
    }
}
