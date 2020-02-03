<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Students
    Route::delete('students/destroy', 'StudentController@massDestroy')->name('students.massDestroy');
    Route::post('students/media', 'StudentController@storeMedia')->name('students.storeMedia');
    Route::post('students/ckmedia', 'StudentController@storeCKEditorImages')->name('students.storeCKEditorImages');
    Route::resource('students', 'StudentController');

    // Book Dates
    Route::delete('book-dates/destroy', 'BookDateController@massDestroy')->name('book-dates.massDestroy');
    Route::get('book-dates/edit/{id}','BookDateController@edit')->name('book-dates.edit');
    Route::patch('book-dates/update/{id}','BookDateController@update')->name('book-dates.update');
    Route::get('book-dates/show/{id}','BookDateController@show')->name('book-dates.show');
    Route::delete('book-dates/{id}','BookDateController@destroy')->name('book-dates.destroy');
    Route::get('book-dates/create/{id}', 'BookDateController@create')->name('book-dates.create');
    Route::post('book-dates/store/{id}', 'BookDateController@store')->name('book-dates.store');
    Route::get('book-dates','BookDateController@index')->name('book-dates.index');

    // Excel Reports
    Route::delete('excel-reports/destroy', 'ExcelReportController@massDestroy')->name('excel-reports.massDestroy');
    Route::resource('excel-reports', 'ExcelReportController');
    Route::post('excel-reports/parse-csv-import', 'ExcelReportController@parseCsvImport')->name('excel-reports.parseCsvImport');
    Route::post('excel-reports/process-csv-import', 'ExcelReportController@processCsvImport')->name('excel-reports.processCsvImport');

    // Locations
    Route::delete('locations/destroy', 'LocationController@massDestroy')->name('locations.massDestroy');
    Route::resource('locations', 'LocationController');

    // Modules
    Route::delete('modules/destroy', 'ModuleController@massDestroy')->name('modules.massDestroy');
    Route::resource('modules', 'ModuleController');

    // conductors
    Route::delete('conductors/destroy', 'ConductorController@massDestroy')->name('conductors.massDestroy');
    Route::resource('conductors', 'ConductorController');

    // Available Dates
    Route::delete('available-dates/destroy', 'AvailableDateController@massDestroy')->name('available-dates.massDestroy');
    Route::resource('available-dates', 'AvailableDateController');
    Route::get('available-dates/status/{id}', 'AvailableDateController@status')->name('available-dates.status');

    //Payments
    Route::get('payments/create/{id}', 'PaymentController@create')->name('payments.create');
    Route::post('payment/store/{id}','PaymentController@store')->name('payments.store');

});

Route::group(['prefix' => 'student', 'as' => 'student.', 'namespace' => 'Frontend'], function () {

    //Student
    //Entry-form
    Route::get('entry-form','EntryFormController@create')->name('entry-form');
    Route::post('entry-form/store','EntryFormController@store')->name('entry-form.store');
    Route::get('entry-form/edit/{id}','EntryFormController@edit')->name('entry-form.edit');
    Route::put('entry-form/update/{id}','EntryFormController@update')->name('entry-form.update');

    //Book-date
    Route::get('date-booking/{id}','DateBookingController@create')->name('date-booking');
    Route::post('date-booking/store/{id}','DateBookingController@store')->name('date-booking.store');


    //Payment
    Route::get('date-payment/{id}','DatePaymentController@create')->name('date-payment');
    Route::post('date-payment/{id}','DatePaymentController@store')->name('date-payment.store');

    Route::get('payment','DatePaymentController@index')->name('payment');

    Route::post('verification','DatePaymentController@verification')->name('date-payment.verification');

    Route::get('test', 'DatePaymentController@test');



});

