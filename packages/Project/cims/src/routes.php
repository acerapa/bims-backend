<?php

/**
 * cims/auth_brgy?email=&password=&city_code=&brgy_code=&device=&datetime
 * cims/variables
 * 
 * cims/resident_registration?
 */

Route::group(['prefix' => 'cims'], function () {
    Route::get("auth_brgy",[Project\CIMS\Authentication::class, 'barangayHall']);
    Route::get("variables",[Project\CIMS\CIMSController::class, 'variables']);

    Route::get("resident_registration",[Project\CIMS\ResidentRegistration::class, 'register']);
    Route::get("resident_masterlist",[Project\CIMS\ResidentMasterlist::class, 'get']);
});