<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;

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

Route::group([ 'middleware' => ['ieltsbooking']], function(){
    Route::apiResources([
        'date-booking' => 'Api\V1\Student\ApiDateBookingController',
    ]);
    Route::apiResources([
        'student-form' => 'Api\V1\Student\ApiStudentFormController',
    ]);
    Route::apiResources([
        'payment/verify'   =>  'Api\V1\Student\ApiDatePaymentController'
    ]);
});

// Route::post('/book-date', function(Request $request){
//     return response()->json([
//         'req'=> $request->toArray()
//     ]);
// });