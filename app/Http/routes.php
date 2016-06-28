<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('home');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::auth();
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth.admin'], function () {

    Route::get('home', ['as' => 'admin.home', 'uses' => 'HomeController@index']);
    Route::resource('users', 'UserController');
    Route::post('users/destroyall',['as'=>'admin.users.destroy.all','uses'=>'UserController@destroyAll']);
    Route::resource('role', 'RoleController');
    Route::post('role/destroyall',['as'=>'admin.role.destroy.all','uses'=>'RoleController@destroyAll']);
    Route::get('role/{id}/permissions',['as'=>'admin.role.permissions','uses'=>'RoleController@permissions']);
    Route::post('role/{id}/permissions',['as'=>'admin.role.permissions','uses'=>'RoleController@storePermissions']);
    Route::resource('permission', 'PermissionController');
    Route::post('permission/destroyall',['as'=>'admin.permission.destroy.all','uses'=>'PermissionController@destroyAll']);
    Route::post('upload/uploadFile',['as'=>'admin.upload.uploadfile','uses'=>'UploadController@uploadFile']);


    Route::resource('registers', 'RegisterController');
    Route::post('registers/destroyall',['as'=>'admin.registers.destroy.all','uses'=>'RegisterController@destroyAll']);

});
Route::auth();
Route::get('/home', 'HomeController@index');
