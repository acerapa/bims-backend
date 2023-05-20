<?php

    Route::group(['prefix' => 'foxcity'], function () {
        Route::get("init",[Project\Foxcity\Init::class, 'fetch']);
        Route::get("storeProfile",[Project\Foxcity\StoreProfile::class, 'get']);
        Route::get("generateStoreProfiles",[Project\Foxcity\ScheduleTaskStore::class, 'generateStoreProfiles']);
        Route::get("userRegistrationClone",[Project\Foxcity\UserRegistrationClone::class, 'clone']);
    });