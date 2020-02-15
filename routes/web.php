<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::resources([
    'assessee' => 'AssesseeController',
    'tax_return' => 'TaxReturnController',
    'profile' => 'ProfileController',
]);

Route::post('assessee/preview', 'AssesseeController@preview');
Route::post('assessee/confirm_upload', 'AssesseeController@confirm_upload');

// export
Route::get('export/allAssessee', 'ExcelExportController@allAssessee')->name('export.allAssessee');
Route::get('export/allSubmitedAssessee', 'ExcelExportController@allSubmitedAssessee')->name('export.allSubmitedAssessee');
Route::get('export/allNonSubmitedAssessee', 'ExcelExportController@allNonSubmitedAssessee')->name('export.allNonSubmitedAssessee');

// report controllers
Route::get('report/submited', 'ReportController@submited')->name('report.submited');
Route::get('report/nonSubmited', 'ReportController@nonSubmited')->name('report.nonSubmited');
