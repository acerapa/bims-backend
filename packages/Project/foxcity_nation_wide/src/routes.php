<?php

    Route::group(['prefix' => 'foxcity'], function () {
        Route::get("init",[Project\Foxcity\Init::class, 'fetch']);
        Route::get("storeProfile",[Project\Foxcity\StoreProfile::class, 'get']);
        Route::get("generateStoreProfiles",[Project\Foxcity\ScheduleTaskStore::class, 'generateStoreProfiles']);
        Route::get("userRegistrationClone",[Project\Foxcity\UserRegistrationClone::class, 'clone']);
        
        Route::get("mycartProfileLocal/{json_file}/{user_refid}/{store_refid}/{lat}/{lng}",[Project\Foxcity\MyCartProfile::class, 'local']);

        /** CLONE DATA START */
        Route::get("connection",[Project\Foxcity\CloneData::class, 'connection']);
        Route::get("fetchStores",[Project\Foxcity\CloneData::class, 'fetchStores']);
        Route::get("fetchStoresFixLogo",[Project\Foxcity\CloneData::class, 'fetchStoresFixLogo']);
        Route::get("fetchStoresFixCover",[Project\Foxcity\CloneData::class, 'fetchStoresFixCover']);
        /** CLONE DATA END */
    });