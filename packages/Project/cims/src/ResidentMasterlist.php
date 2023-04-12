<?php

namespace Project\CIMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * cims/resident_search?city_code=072234&brgy_code=072234011&surname=&firstname=Ang
 * cims/resident_masterlist?city_code=072234&brgy_code=072234011
 */

class ResidentMasterlist extends Controller
{
    public static function search(Request $request) {

        $surname    = $request['surname'];
        $firstname  = $request['firstname'];

        return DB::table("plugin_user")
        ->join("cims_user_location","plugin_user.reference_id","=","cims_user_location.user_refid")
        ->where([
            ["cims_user_location.city_code","=", $request['city_code']],
            ["cims_user_location.brgy_code","=", $request['brgy_code']]
        ])
        ->where(function ($query) use ($surname, $firstname) {
            return $query
                ->where("plugin_user.lastname","LIKE", $surname."%")
                ->where("plugin_user.firstname","LIKE", $firstname."%");
        })
        ->select(
            "plugin_user.reference_id",
            "plugin_user.firstname",
            "plugin_user.lastname",
            "plugin_user.middlename",
            "plugin_user.gender",
            "plugin_user.birthday",
            "plugin_user.mobile",
            "plugin_user.email",
            "plugin_user.photo",
            "plugin_user.created_at",
            "plugin_user.photo"
        )
        ->orderBy("plugin_user.lastname","ASC")
        ->paginate(25);
    }

    public static function get(Request $request) {
        return DB::table("plugin_user")
        ->join("cims_user_location","plugin_user.reference_id","=","cims_user_location.user_refid")
        ->where([
            ["cims_user_location.city_code", $request['city_code']],
            ["cims_user_location.brgy_code", $request['brgy_code']]
        ])
        ->select(
            "plugin_user.reference_id",
            "plugin_user.firstname",
            "plugin_user.lastname",
            "plugin_user.middlename",
            "plugin_user.gender",
            "plugin_user.birthday",
            "plugin_user.mobile",
            "plugin_user.email",
            "plugin_user.photo",
            "plugin_user.created_at",
            "plugin_user.photo"
        )
        ->orderBy("plugin_user.lastname","ASC")
        ->paginate(25);
    }
}
