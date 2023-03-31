<?php

/**
 * 
 * cms/variables
 */

Route::group(['prefix' => 'cms'], function () {
    Route::get("variables",[Project\CIMS\CIMSController::class, 'variables']);
});