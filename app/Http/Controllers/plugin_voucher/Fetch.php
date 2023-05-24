<?php

namespace App\Http\Controllers\plugin_voucher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * plugin_voucher/fetchAll?status=1&page=1
 * plugin_voucher/fetchByStore?page=1&status=1&creator_refid=STR-05042023044205-QEN
 * \App\Http\Controllers\plugin_voucher\Fetch::fetchSingleVoucher($voucher_refid);
 */

class Fetch extends Controller
{
    public static function fetchSingleVoucher($voucher_refid) {
        return DB::table("plugin_voucher")->where("reference_id", $voucher_refid)->get();
    }

    public static function fetchAll(Request $request) {

        $source = DB::table("plugin_voucher")
        ->select("reference_id as voucher_refid","copy_num","copy_group_refid","creator_type","creator_refid","min_order_cost","voucher_type","voucher_label","voucher_value","valid_from","valid_until")
        ->where("status", $request['status'])
        ->whereDate('valid_from', '<=', Carbon::now())
        ->whereDate('valid_until', '>=', Carbon::now())
        ->orderBy("dataid", "desc")
        ->paginate(25)
        ->toArray();

        $source_data    = $source['data'];
        $list           = [];

        foreach($source_data as $voucher) {
            $list[] = [
                "header"    => $voucher,
                "store"     => \App\Http\Controllers\plugin_store\FetchStoreHeader::get(1, $voucher->creator_refid) 
            ];
        }

        $data = [
            "current_page"      => $source['current_page'],
            "last_page"         => $source['last_page'],
            "from"              => $source['from'],
            "to"                => $source['to'],
            "per_page"          => $source['per_page'],
            "total"             => $source['total'],
            "data"              => $list,
            "hostlink"          => env("FTP_SERVER_HOSTLINK_1")
        ];

        return $data;
    }

    public static function fetchByStore(Request $request) {

        $source = DB::table("plugin_voucher")
        ->select("reference_id as voucher_refid","copy_num","copy_group_refid","creator_type","creator_refid","min_order_cost","voucher_type","voucher_label","voucher_value","valid_from","valid_until")
        ->where([
            ["creator_refid", $request['creator_refid']],
            ["status", $request['status']]
        ])
        ->whereDate('valid_from', '<=', Carbon::now())
        ->whereDate('valid_until', '>=', Carbon::now())
        ->orderBy("dataid", "desc")
        ->paginate(25)
        ->toArray();

        $source_data    = $source['data'];
        $list           = [];

        foreach($source_data as $voucher) {
            $list[] = [
                "header"    => $voucher,
                "store"     => \App\Http\Controllers\plugin_store\FetchStoreHeader::get(1, $voucher->creator_refid) 
            ];
        }

        $data = [
            "current_page"      => $source['current_page'],
            "last_page"         => $source['last_page'],
            "from"              => $source['from'],
            "to"                => $source['to'],
            "per_page"          => $source['per_page'],
            "total"             => $source['total'],
            "data"              => $list,
            "hostlink"          => env("FTP_SERVER_HOSTLINK_1")
        ];

        return $data;
    }
}
