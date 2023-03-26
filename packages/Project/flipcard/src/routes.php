<?php




Route::group(['prefix' => 'flipcard'], function () {
    Route::get("submit",[Project\Flipcard\FlipcardController::class, 'submit']);
    Route::get("cashout",[Project\Flipcard\FlipcardController::class, 'cashout']);
});


