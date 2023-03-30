<?php

/**
 * 
 * deanlief/variables
 */

Route::group(['prefix' => 'deanlief'], function () {
    Route::get("delete_listing/{listing_refid}",[Project\Deanlief\DeanliefController::class, 'delete_listing']);
    Route::get("search_listing",[Project\Deanlief\DeanliefController::class, 'search_listing']);
    Route::get("variables",[Project\Deanlief\DeanliefController::class, 'variables']);
});
