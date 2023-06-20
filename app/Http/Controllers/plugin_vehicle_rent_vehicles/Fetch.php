<?php

namespace App\Http\Controllers\plugin_vehicle_rent_vehicles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_vehicle_rent_vehicles/fetch?user_refid=USR-033121093459-TCS&city_code=072250&group=MTRCL&page=1
 * 
 */

class Fetch extends Controller
{
    public static function fetch(Request $request) {
        $source = DB::table("plugin_vehicle_rent_vehicles")
        ->paginate(12)
        ->toArray();

        $data_list = $source['data'];

        $temp = [];
        foreach($data_list as $item) {

            $price_base             = floatval($item->price_base);
            $service_fee            = floatval($item->service_fee);
            $service_fee_amount     = ($service_fee / 100) * $price_base;
            $price_charged          = $price_base + $service_fee_amount;

            $temp[] = [
                "reference_id"      => $item->reference_id,
                "branch_refid"      => $item->branch_refid,
                "group"             => $item->group,
                "name"              => $item->name,
                "description"       => $item->description,
                "address"           => $item->address,
                "photos"            => json_decode($item->photos),
                "price_base"        => $price_base,
                "service_fee"       => $service_fee,
                "service_fee_amount"=> $service_fee_amount,
                "price_charged"     => $price_charged,
                "insured"           => $item->insured,
                "city_code"         => $item->city_code,
                "owner_refid"       => $item->owner_refid,
                "available"         => $item->available
            ];
        }

        return [
            "current_page"      => $source['current_page'],
            "last_page"         => $source['last_page'],
            "from"              => $source['from'],
            "to"                => $source['to'],
            "per_page"          => $source['per_page'],
            "total"             => $source['total'],
            "data"              => $temp
        ];
    }
}
