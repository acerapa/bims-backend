<?php

namespace Project\Foxcity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * 
 */

class ScheduleTaskStore extends Controller
{
    public static function generateStoreProfiles() {

        /**
         * Run every day
         */

        $store_list = DB::table("plugin_store")->select("dataid", "reference_id")->get();

        $generate_list = [];
        foreach($store_list as $store) {

            $store_profile = \Project\Foxcity\StoreProfile::method([
                "store_refid"   => $store->reference_id,
                "json_file"   => 0
            ]);

            $generate_list[] = [
                "store_refid"       => $store->reference_id,
                "store_profile"     => $store_profile
            ];
        }

        return $generate_list;

    }
}
