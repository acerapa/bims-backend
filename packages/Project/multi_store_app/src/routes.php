<?php

    Route::group(['prefix' => 'multistoreapp'], function () {
        Route::get("init/{user_refid}",[Project\MultiStoreApp\Init::class, 'get']);
    });