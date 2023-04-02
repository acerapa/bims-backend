<?php

/**
 * cims/auth_brgy?email=&password=&city_code=&brgy_code=&device=&datetime
 * cims/variables
 */

Route::group(['prefix' => 'cims'], function () {
    Route::get("auth_brgy",[Project\CIMS\Authentication::class, 'barangayHall']);
    Route::get("variables",[Project\CIMS\CIMSController::class, 'variables']);
});