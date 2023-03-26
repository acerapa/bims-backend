<?php




Route::group(['prefix' => 'flipcard'], function () {
    Route::get("submit",[Project\Flipcard\FlipcardController::class, 'submit']);
});


