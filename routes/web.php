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

    // Book Dates
    Route::delete('book-dates/destroy', 'BookDateController@massDestroy')->name('book-dates.massDestroy');
    Route::get('book-dates/edit/{id}','BookDateController@edit')->name('book-dates.edit');
    Route::patch('book-dates/update/{id}','BookDateController@update')->name('book-dates.update');
    Route::get('book-dates/show/{id}','BookDateController@show')->name('book-dates.show');
    Route::delete('book-dates/{id}','BookDateController@destroy')->name('book-dates.destroy');
    Route::get('book-dates/create', 'BookDateController@create')->name('book-dates.create');
    Route::post('book-dates/store', 'BookDateController@store')->name('book-dates.store');
    Route::get('book-dates','BookDateController@index')->name('book-dates.index');

    // Students
    Route::delete('students/destroy', 'StudentController@massDestroy')->name('students.massDestroy');
    Route::post('students/media', 'StudentController@storeMedia')->name('students.storeMedia');
    Route::post('students/ckmedia', 'StudentController@storeCKEditorImages')->name('students.storeCKEditorImages');
    Route::get('students/create/{id}', 'StudentController@create')->name('students.create');
    Route::post('students/store/{id}', 'StudentController@store')->name('students.store');
    Route::get('students', 'StudentController@index')->name('students.index');
    Route::get('students/edit/{id}','StudentController@edit')->name('students.edit');
    Route::patch('students/update/{id}','StudentController@update')->name('students.update');
    Route::get('students/show/{id}','StudentController@show')->name('students.show');
    Route::delete('students/{id}','StudentController@destroy')->name('students.destroy');

    // Excel Reports
    Route::delete('excel-reports/destroy', 'ExcelReportController@massDestroy')->name('excel-reports.massDestroy');
    Route::resource('excel-reports', 'ExcelReportController');

    Route::get('excel-report/pending','ExcelReportController@excelForPending')->name('excel-reports.pending');
    Route::get('excel-report/approved','ExcelReportController@excelForApproved')->name('excel-reports.approved');

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

    //Date-Booking Status Change
    Route::get('status/create/{id}', 'StatusController@create')->name('status.create');
    Route::post('status/store/{id}','StatusController@store')->name('status.store');

});

Route::group(['prefix' => 'student', 'as' => 'student.', 'namespace' => 'Frontend'], function () {

    //Student

    //Book-date
    Route::get('date-booking','DateBookingController@create')->name('date-booking');
    Route::post('date-booking/store','DateBookingController@store')->name('date-booking.store');

    //Entry-form
    Route::get('entry-form/{id}','EntryFormController@create')->name('entry-form');
    Route::post('entry-form/store/{id}','EntryFormController@store')->name('entry-form.store');

    Route::get('details','EntryFormController@details')->name('details');
    Route::get('student-detail','EntryFormController@studentDetail')->name('student-detail');

    //Payment
    Route::post('date-payment/direct','DatePaymentController@directPayment')->name('date-payment.direct');
    Route::get('date-payment/{id}','DatePaymentController@create')->name('date-payment');
    Route::post('verification','DatePaymentController@verification')->name('date-payment.verification');
    Route::get('payment-result/{id}', 'DatePaymentController@paymentResult')->name('date-payment.payment-result');
    Route::get('make/payment', 'DatePaymentController@makePayment')->name('make-payment');

    //home page
    Route::get('landing/home','LandingController@home')->name('landing.home');
    Route::get('ielts','LandingController@ielts')->name('ielts');
    Route::get('pte','LandingController@pte')->name('pte');

    Route::get('temp','DatePaymentController@generateBarcodeNumber')->name('generateBarcodeNumber');


});
