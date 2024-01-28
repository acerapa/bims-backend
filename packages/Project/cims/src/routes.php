<?php

/**
 * cims/auth_brgy?email=&password=&city_code=&brgy_code=&device=&datetime
 * cims/access_staff_brgy?user_refid=user_refid&city_code=city_code&brgy_code=brgy_code&created_by=created_by
 * cims/variables
 *
 * cims/barangayProfile?user_refid=USR-12302022065909-VWP&city_code=072234&brgy_code=072234011
 * cims/resident_search?city_code=072234&brgy_code=072234011
 *
 * cims/incident_report_registration?reference_id=&city_code=&brgy_code=&incident_type=&incident_date=&incident_time=&location_text=&location_lat=&location_lon=&incident_narrative=&action_taken=&recomendation=&prepared_date=&prepared_by=&created_by=
 */

Route::group(['prefix' => 'cims'], function () {
    Route::get("auth_brgy",[Project\CIMS\Authentication::class, 'barangayHall']);
    Route::get("access_staff_brgy",[Project\CIMS\Authentication::class, 'accessStaffBarangay']);
    Route::get("variables",[Project\CIMS\CIMSController::class, 'variables']);

    Route::get("barangayProfile",[Project\CIMS\BarangayProfile::class, 'get']);

    Route::get("resident_registration",[Project\CIMS\ResidentRegistration::class, 'register']);
    Route::get("resident_bulk_registration",[Project\CIMS\ResidentRegistration::class, 'bulk_register']);
    Route::get("resident_search",[Project\CIMS\ResidentMasterlist::class, 'search']);
    Route::get("resident_masterlist",[Project\CIMS\ResidentMasterlist::class, 'get']);

    Route::get("resident_all", [\Project\CIMS\ResidentMasterlist::class, 'all']);

    Route::get("incident_report_registration",[Project\CIMS\BrgyIncidentReportRegistration::class, 'register']);
    Route::get("all_incident_reports", [\Project\CIMS\BrgyIncidentReportRegistration::class, 'all']);

    Route::get("barangay_printables", [\Project\CIMS\PritableDocuments::class, 'register']);
});
