<?php

namespace App\Http\Controllers\plugin_delete_recyclable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * \App\Http\Controllers\plugin_delete_recyclable\Delete::delete($table, $where);
 * 
 * Example:
 * 
 *      $table = "plugin_product_addons";
 *      $where = ["reference_id" => "PAO-05112023033205-BPO"];
 *      return \App\Http\Controllers\plugin_delete_recyclable\Delete::delete($table, $where, "Jason");
 */

class Delete extends Controller
{
    public static function delete($table, $where, $user_refid) {
        
        $data = DB::table($table)
        ->where($where)
        ->get();

        if(count($data) > 0) {
            $created = DB::table("plugin_recycle_bin")->insert([
                "table_src"     => $table,
                "where_src"     => json_encode($where),
                "data_object"   => json_encode($data),
                "deleted_by"    => $user_refid
            ]);

            if($created) {
                DB::table($table)->where($where)->delete();
                return [
                    "success"   => true,
                    "message"   => "Delete successfully"
                ];
            }
            else {
                return [
                    "success"   => false,
                    "message"   => "Unable to delete data"
                ];
            }
        }
        else {
            return [
                "success"   => false,
                "message"   => "No deletable data found"
            ];
        }
    }
}
