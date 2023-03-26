<?php




Route::group(['prefix' => 'flipcard'], function () {
    Route::get("set",[Project\Flipcard\FlipcardController::class, 'set']);
});


