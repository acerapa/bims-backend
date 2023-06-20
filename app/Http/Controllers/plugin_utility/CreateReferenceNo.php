<?php

namespace App\Http\Controllers\plugin_utility;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * 
 * \App\Http\Controllers\plugin_utility\CreateReferenceNo::create('IMG');
 */

class CreateReferenceNo extends Controller
{
    public static function create($identifier) {

        $DATE   = date('m').date('d').date('Y').date('h').date('i').date('s');
        $CHAR   = str_shuffle("1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ");
        
        $list   = [
            ["table" => "plugin_banner","key"                               => "BNR"],
            ["table" => "plugin_order_item","key"                           => "CIT"],
            ["table" => "plugin_order_placed","key"                         => "PLC"],
            ["table" => "plugin_photo","key"                                => "IMG"],
            ["table" => "plugin_product","key"                              => "PRD"],
            ["table" => "plugin_product_addons","key"                       => "PAD"],
            ["table" => "plugin_product_category_global","key"              => "PGC"],
            ["table" => "plugin_product_category_global_subcategories","key"=> "PSC"],
            ["table" => "plugin_product_discount","key"                     => "PDC"],
            ["table" => "plugin_product_review","key"                       => "PRV"],
            ["table" => "plugin_store","key"                                => "STR"],
            ["table" => "plugin_store_menu_group","key"                     => "SMN"],
            ["table" => "plugin_user","key"                                 => "USR"],
            ["table" => "plugin_vehicle_rent_vehicles","key"                => "VRV"],
            ["table" => "plugin_voucher","key"                              => "VCH"],
            ["table" => "plugin_user_address_local","key"                   => "UAL"]
        ];

        $key = $identifier;
        for($i = 0; $i < count($list); $i++) {
            if($list[$i]["table"] == $identifier) {
                $key = $list[$i]["key"];
            }
        }

        return $key ."-".$DATE."-".substr($CHAR, 0, 3);
    }
}
