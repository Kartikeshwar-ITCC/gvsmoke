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

Route::get('agency', 'AgencyController@index')->name('agency');
Route::get('agency/add', 'AgencyController@add')->name('agencyAdd');
Route::get('agency/edit/{id}', 'AgencyController@edit')->name('agencyEdit');
Route::post('agency/update', 'AgencyController@postUpdate')->name('agencyPostUpdate');
Route::delete('agency/delete', 'AgencyController@postDelete')->name('agencyPostDelete');


Route::get('job', 'JobController@index')->name('job');
Route::post('job', 'JobController@postIndex')->name('postJob');

Route::get('job/pending', 'JobController@getPending')->name('jobPending');
Route::post('job/pending', 'JobController@postPendingIndex')->name('postPendingIndex');

Route::get('job/deleted', 'JobController@getDeleted')->name('jobDeleted');
Route::post('job/deleted', 'JobController@postDeletedIndex')->name('postDeletedIndex');

Route::get('job/add', 'JobController@add')->name('jobAdd');
Route::get('job/edit/{id}', 'JobController@edit')->name('jobEdit');
Route::get('job/preview/{id}', 'JobController@preview')->name('jobPreviewChanges');
Route::get('job/previewedit/{id}', 'JobController@previewEdit')->name('jobPreviewEditChanges');
Route::get('job/approve/{id}', 'JobController@postApprove')->name('jobPostApprove');
Route::post('job/approve/{id}', 'JobController@postApprove')->name('jobPostApprove');
Route::get('job/decline/{id}', 'JobController@postDecline')->name('jobPostDecline');
Route::get('job/restore/{id}', 'JobController@postRestore')->name('jobPostRestore');
Route::post('job/update', 'JobController@postUpdate')->name('jobPostUpdate');
Route::delete('job/delete', 'JobController@postDelete')->name('jobPostDelete');
Route::post('job/changejobbulkstatus', 'JobController@changeJobBulkStatus')->name('changeJobBulkStatus');

Route::get('profile/edit', 'ProfileController@edit')->name('profileEdit');
Route::post('profile/update', 'ProfileController@postUpdate')->name('profilePostUpdate');


Route::get('testing', 'JobController@testing')->name('testing');

