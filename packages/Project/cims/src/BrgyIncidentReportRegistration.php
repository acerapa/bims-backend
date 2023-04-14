<?php

namespace Project\CIMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * ?reference_id=&city_code=&brgy_code=&incident_type=&incident_date=&incident_time=&location_text=&location_lat=&location_lon=&incident_narrative=&action_taken=&recomendation=&prepared_date=&prepared_by=&created_by=
 * 
 */

class BrgyIncidentReportRegistration extends Controller
{
    public static function register(Request $request) {
        $data = DB::table("cims_brgy_incident_report")->insert([
            "reference_id"          => $request['reference_id'],
            "city_code"             => $request['city_code'],
            "brgy_code"             => $request['brgy_code'],
            "incident_type"         => $request['incident_type'],
            "incident_date"         => $request['incident_date'],
            "incident_time"         => $request['incident_time'],
            "location_text"         => $request['location_text'],
            "location_lat"          => $request['location_lat'],
            "location_lon"          => $request['location_lon'],
            "incident_narrative"    => $request['incident_narrative'],
            "action_taken"          => $request['action_taken'],
            "recomendation"         => $request['recomendation'],
            "prepared_date"         => $request['prepared_date'],
            "prepared_by"           => $request['prepared_by'],
            "created_at"            => date("Y-m-d h:i:s"),
            "created_by"            => $request['created_by'],
            "status"                => 1
        ]);

        if($data) {
            return [
                "success"   => true,
                "message"   => "Successfully registered"
            ];
        }
        else {
            return [
                "success"   => false,
                "message"   => "Unable to register incident report, please try again later."
            ];
        }
    }

    public static function involved(Request $request) {
        
    }
}
