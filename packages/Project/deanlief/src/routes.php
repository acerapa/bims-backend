<?php




Route::group(['prefix' => 'deanlief'], function () {
    Route::get("delete_listing/{listing_refid}",[Project\Flipcard\DeanliefController::class, 'delete_listing']);
    Route::get("search_listing",[Project\Flipcard\DeanliefController::class, 'search_listing']);
});
