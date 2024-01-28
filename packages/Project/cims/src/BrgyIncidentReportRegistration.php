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

    public static function all() {
        return DB::table('cims_brgy_incident_report')
            ->join('cims_brgy_incident_report_type', 'cims_brgy_incident_report.incident_type', '=', 'cims_brgy_incident_report_type.reference_id')
            ->join('plugin_user', 'cims_brgy_incident_report.created_by', 'plugin_user.reference_id')
            ->select('cims_brgy_incident_report.*','cims_brgy_incident_report_type.name as type_name', DB::raw('CONCAT(plugin_user.firstname," ",plugin_user.lastname) as created_by_name'))
            ->get();
    }
}
