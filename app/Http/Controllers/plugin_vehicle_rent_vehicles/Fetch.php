<?php

namespace App\Http\Controllers\plugin_vehicle_rent_vehicles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * plugin_vehicle_rent_vehicles/fetch?user_refid=USR-033121093459-TCS&city_code=072250&group=MTRCL&page=1
 * plugin_vehicle_rent_vehicles/fetchSingle?reference_id=VRB-07032023114741-3KJ
 * 
 */

class Fetch extends Controller
{
    public static function fetch(Request $request) {

        $city_code = $request['city_code'];

        $source = DB::table("plugin_vehicle_rent_vehicles")
        ->where([
            ["city_code", $city_code],
            ["group", $request['group']]
        ])
        ->paginate(6)
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
                "fuel_type"         => $item->fuel_type,
                "seats"             => $item->seats,
                "gear_lever"        => $item->gear_lever,
                "airconditioned"    => $item->airconditioned,
                "photos"            => json_decode($item->photos),
                "price_base"        => $price_base,
                "service_fee"       => $service_fee,
                "driver_fee"        => floatval($item->driver_fee),
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

    public static function single(Request $request) {
        $data = DB::table("plugin_vehicle_rent_booking")->where("reference_id", $request['reference_id'])->get();
        if(count($data) > 0) {
            return [
                "success"   => true,
                "header"    => [
                    "reference_id"          => $data[0]->reference_id,
                    "branch_refid"          => $data[0]->branch_refid,
                    "vehicle_refid"         => $data[0]->vehicle_refid,
                    "user_refid"            => $data[0]->user_refid,
                    "rent_from"             => $data[0]->rent_from,
                    "rent_to"               => $data[0]->rent_to,
                    "price_base"            => floatval($data[0]->price_base),
                    "price_charged"         => floatval( $data[0]->price_charged),
                    "service_fee"           => floatval($data[0]->service_fee),
                    "service_fee_amount"    => floatval($data[0]->service_fee_amount),
                    "driver"                => $data[0]->driver,
                    "driver_text"           => Fetch::driver_text($data[0]->driver),
                    "driver_fee"            => floatval($data[0]->driver_fee),
                    "message"               => $data[0]->message,
                    "convo_refid"           => $data[0]->convo_refid,
                    "total"                 => floatval($data[0]->total),
                    "created_at"            => $data[0]->created_at,
                    "status"                => $data[0]->status,
                    "status_text"           => Fetch::status_text($data[0]->status),
                ],
                "vehicle_info"              => Fetch::vehicle_info($data[0]->vehicle_refid),
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Transaction not found"
            ];
        }
    }

    public static function vehicle_info($vehicle_refid) {
        $data = \App\Http\Controllers\plugin_query\GetRowBasic::get("plugin_vehicle_rent_vehicles", "all", "reference_id", $vehicle_refid);
        if(count($data) > 0 ) {
            return [
                "success"               => true,
                "reference_id"          => $data[0]->reference_id,
                "branch_refid"          => $data[0]->branch_refid,
                "group"                 => $data[0]->group,
                "name"                  => $data[0]->name,
                "description"           => $data[0]->description,
                "owner_refid"           => $data[0]->owner_refid,
                "owner_name"            => $data[0]->owner_name,
                "owner_mobile"          => $data[0]->owner_mobile,
                "owner_email"           => $data[0]->owner_email,
                "address"               => $data[0]->address,
                "fuel_type"             => $data[0]->fuel_type,
                "seats"                 => $data[0]->seats,
                "gear_lever"            => $data[0]->gear_lever,
                "gear_lever_text"       => Fetch::gear_lever_text($data[0]->gear_lever),
                "airconditioned"        => $data[0]->airconditioned,
                "airconditioned_text"   => Fetch::airconditioned_text($data[0]->airconditioned),
                "photos"                => json_decode($data[0]->photos),
                "price_base"            => floatval($data[0]->price_base),
                "service_fee"           => floatval($data[0]->service_fee),
                "driver_fee"            => floatval($data[0]->driver_fee),
                "insured"               => $data[0]->insured,
                "insured_text"          => Fetch::insured_text($data[0]->insured),
                "city_code"             => $data[0]->city_code,
                "available"             => $data[0]->available,
                "available_text"        => Fetch::available_text($data[0]->available),
            ];
        }
        else {
            return [
                "success"   => false
            ];
        }
    }

    public static function status_text($status) {
        $status = intval($status);
        if($status == 1) {
            return "New";
        }
        else if($status == 2) {
            return "Cancelled by customer";
        }
        else if($status == 3) {
            return "Accepted";
        }
        else if($status == 4) {
            return "Done";
        }
        else {
            return $status;
        }
    }

    public static function driver_text($driver) {
        if($driver == 'SD') {
            return "Self Drive";
        }
        else if($driver == 'ID') {
            return "Include Driver";
        }
        else {
            return $driver;
        }
    }

    public static function gear_lever_text($gear_lever) {
        if($gear_lever == 'MNL') {
            return "Manual";
        }
        else if($gear_lever == 'AUT') {
            return "Automatic";
        }
        else {
            return $gear_lever;
        }
    }

    public static function insured_text($insured) {
        $insured = intval($insured);
        if($insured == 1) {
            return "Yes";
        }
        else if($insured == 0) {
            return "No";
        }
        else {
            return $insured;
        }
    }

    public static function airconditioned_text($airconditioned) {
        $airconditioned = intval($airconditioned);
        if($airconditioned == 1) {
            return "Yes";
        }
        else if($airconditioned == 0) {
            return "No";
        }
        else {
            return $airconditioned;
        }
    }

    public static function available_text($available) {
        $available = intval($available);
        if($available == 1) {
            return "Yes";
        }
        else if($available == 0) {
            return "No";
        }
        else {
            return $available;
        }
    }
}
