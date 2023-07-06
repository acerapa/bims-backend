<?php

namespace App\Http\Controllers\plugin_oncall_service_providers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * api/plugin_oncall_service_providers/init?json_file=1&service=all&user_refid=&city_code=072250&branch_refid=BRC-06122023113052-DPS
 * 
 */

class Fetch extends Controller
{
    public static function init(Request $request) {

        $json_file      = intval($request['json_file']);
        $service        = $request['service'];
        $city_code      = $request['city_code'];
        $branch_refid   = $request['branch_refid'];
        $branch_info    = \App\Http\Controllers\plugin_branch\Fetch::get($json_file, $branch_refid);

        return [
            "services"              => \App\Http\Controllers\plugin_oncall_service_services\Fetch::method($json_file),
            "branch_info"           => $branch_info,
            "offers_recommended"    => Fetch::offers_recommended($branch_info['neighboring_cities'], $service),
            "offers_regular"        => Fetch::offers_regular($branch_info['neighboring_cities'], $service)
        ];
    }

    public static function offers_recommended($city_code_list, $service) {
        if($service == 'all') {
            $data = DB::table("plugin_oncall_service_providers")
            ->whereIn("city_code", $city_code_list)
            ->where([
                ["available", 1],
                ["recommended", 1]
            ])
            ->limit(100)
            ->get();
        }
        else {
            $data = DB::table("plugin_oncall_service_providers")
            ->whereIn("city_code", $city_code_list)
            ->where([
                ["service", $service],
                ["available", 1],
            ])
            ->limit(100)
            ->get();
        }   

        $list = [];
        foreach($data as $item) {
            $list[] = [
                "reference_id"  => $item->reference_id,
                "branch_refid"  => $item->branch_refid,
                "city_code"     => $item->city_code,
                "fname"         => $item->fname,
                "lname"         => $item->lname,
                "address"       => $item->address,
                "email"         => $item->email,
                "mobile"        => $item->mobile,
                "service"       => $item->service,
                "service_text"  => Fetch::service_text($item->service),
                "available"     => $item->available,
                "review_score"  => $item->review_score,
                "recommended"   => $item->recommended,
                "profile_photo" => json_decode($item->profile_photo),
                "cover_photo"   => json_decode($item->cover_photo),
                "provider_fee"  => floatval($item->provider_fee)
            ];
        }

        return $list;
    }

    public static function offers_regular($city_code_list, $service) {
        if($service == 'all') {
            $data = DB::table("plugin_oncall_service_providers")
            ->whereIn("city_code", $city_code_list)
            ->where("available", 1)
            ->paginate(25)
            ->toArray();
        }
        else {
            $data = DB::table("plugin_oncall_service_providers")
            ->whereIn("city_code", $city_code_list)
            ->where([
                ["service", $service],
                ["available", 1]
            ])
            ->paginate(25)
            ->toArray();
        }

        $data_list          = $data['data'];
        $temp               = [];

        foreach($data_list as $item) {
            $temp[] = [
                "header"            => $item,
                "service_text"      => Fetch::service_text($item->service),
                "profile_photo"     => json_decode($item->profile_photo),
                "cover_photo"       => json_decode($item->cover_photo)
            ];
        }

        return [
            "current_page"      => $data['current_page'],
            "last_page"         => $data['last_page'],
            "from"              => $data['from'],
            "to"                => $data['to'],
            "per_page"          => $data['per_page'],
            "total"             => $data['total'],
            "data"              => $temp,
            "hostlink"          => env("FTP_SERVER_HOSTLINK_1")
        ];
        
    }

    public static function service_text($service_code) {
        $service_list = \App\Http\Controllers\plugin_oncall_service_services\Fetch::method(1);
        for($i = 0; $i < count($service_list); $i++) {
            if($service_code == $service_list[$i]['code']) {
                return $service_list[$i]['service'];
            }
        }
        return $service_code;
    }
}
