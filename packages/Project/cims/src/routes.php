<?php

/**
 * cims/auth_brgy?email=&password=&city_code=&brgy_code=&device=&datetime
 * cims/variables
 * 
 * cims/barangayProfile?user_refid=USR-12302022065909-VWP&city_code=072234&brgy_code=072234011
 * cims/resident_search?city_code=072234&brgy_code=072234011
 */

Route::group(['prefix' => 'cims'], function () {
    Route::get("auth_brgy",[Project\CIMS\Authentication::class, 'barangayHall']);
    Route::get("variables",[Project\CIMS\CIMSController::class, 'variables']);

    Route::get("barangayProfile",[Project\CIMS\BarangayProfile::class, 'get']);

    Route::get("resident_registration",[Project\CIMS\ResidentRegistration::class, 'register']);
    Route::get("resident_search",[Project\CIMS\ResidentMasterlist::class, 'search']);
    Route::get("resident_masterlist",[Project\CIMS\ResidentMasterlist::class, 'get']);
});