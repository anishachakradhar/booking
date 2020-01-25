<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Students
    Route::post('students/media', 'StudentApiController@storeMedia')->name('students.storeMedia');
    Route::apiResource('students', 'StudentApiController');

    // Book Dates
    Route::apiResource('book-dates', 'BookDateApiController');
    
    // Locations
    Route::apiResource('locations', 'LocationApiController');

    // Available Dates
    Route::apiResource('available-dates', 'AvailableDateApiController');
});
