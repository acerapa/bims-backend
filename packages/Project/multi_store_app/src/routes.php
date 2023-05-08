<?php

    Route::group(['prefix' => 'multistoreapp'], function () {
        Route::get("getInitial",[Project\MultiStoreApp\Init::class, 'getInitial']);
        Route::get("storeProfile/{store_refid}",[Project\MultiStoreApp\StoreProfile::class, 'get']);
    });