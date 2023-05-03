<?php

    Route::group(['prefix' => 'foxcity'], function () {
        Route::get("init",[Project\Foxcity\Init::class, 'fetch']);
    });