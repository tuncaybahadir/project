<?php

/*
|--------------------------------------------------------------------------
| Home Page Route
|--------------------------------------------------------------------------
*/

Route::pattern('string', '[a-z-]+');

Route::get('/', 'HomeController@index');
Route::get('/locale', 'HomeController@locale');


/*
|--------------------------------------------------------------------------
| Admin Auth and Logout Routes
|--------------------------------------------------------------------------
*/

Route::get('admin/login', 'AdminAuthController@index');
Route::post('admin/login', 'AdminAuthController@login');
Route::get('admin/logout', 'AdminAuthController@logout');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::group(array('before' => 'admin'), function () {

    // Admin Dashboard
    Route::get('admin', 'AdminController@index');
    Route::get('admin/password', 'AdminController@password');
    Route::post('admin/password/update', 'AdminController@updatePassword');

    // Admin Users
    Route::get('admin/users', 'AdminUserController@index');
    Route::get('admin/users/create', 'AdminUserController@create');
    Route::post('admin/users/store', array('uses' => 'AdminUserController@store'));
    Route::get('admin/users/edit/{id}', 'AdminUserController@edit');
    Route::post('admin/users/update', array('uses' => 'AdminUserController@update'));
    Route::get('admin/users/delete/{id}', array('uses' => 'AdminUserController@destroy'));

    //Projects
    Route::get('admin/projects', 'AdminProjectsController@index');
    Route::get('admin/projects/create', 'AdminProjectsController@create');
    Route::post('admin/projects/store', array('uses' => 'AdminProjectsController@store'));
    Route::get('admin/projects/edit/{id}', 'AdminProjectsController@edit');
    Route::post('admin/projects/update', array('uses' => 'AdminProjectsController@update'));
    Route::get('admin/projects/delete/{id}', array('uses' => 'AdminProjectsController@destroy'));

    //Version
    Route::get('admin/versions', 'AdminVersionsController@index');
    Route::get('admin/versions/create', 'AdminVersionsController@create');
    Route::post('admin/versions/store', array('uses' => 'AdminVersionsController@store'));
    Route::get('admin/versions/edit/{id}', 'AdminVersionsController@edit');
    Route::post('admin/versions/update', array('uses' => 'AdminVersionsController@update'));
    Route::get('admin/versions/delete/{id}', array('uses' => 'AdminVersionsController@destroy'));
    Route::post('admin/versions/check', array('uses' => 'AdminVersionsController@check'));

    //Values
    Route::get('admin/values', 'AdminValuesController@index');
    Route::get('admin/values/create', 'AdminValuesController@create');
    Route::post('admin/values/store', array('uses' => 'AdminValuesController@store'));
    Route::get('admin/values/edit/{id}', 'AdminValuesController@edit');
    Route::post('admin/values/update', array('uses' => 'AdminValuesController@update'));
    Route::get('admin/values/delete/{id}', array('uses' => 'AdminValuesController@destroy'));
});
