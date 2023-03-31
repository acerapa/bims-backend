<?php

/**
 * 
 * exploriatravel/variables
 */

Route::group(['prefix' => 'exploriatravel'], function () {
    Route::get("variables",[Project\ExploriaTravel\ExploriaTravelController::class, 'variables']);
});