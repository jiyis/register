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

//Route::auth();
Route::get('/login', function(){
    return view('errors/503');
});

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');
Route::get('changepwd', 'UserController@edit');
Route::patch('changepwd/update/{role} ', ['as'=>'user.update','uses'=>'UserController@update']);
Route::post('home/store', ['as'=>'home.store','uses'=>'HomeController@store']);
Route::get('home/getAcademy', ['as'=>'home.getAcademy','uses'=>'HomeController@getAcademy']);
Route::post('upload/uploadFile',['as'=>'upload.uploadfile','uses'=>'UploadController@uploadFile']);
Route::post('upload/uploadImage',['as'=>'upload.uploadimage','uses'=>'UploadController@uploadImage']);
Route::post('upload/deleteFile',['as'=>'upload.deletefile','uses'=>'UploadController@deleteFile']);
Route::get('download/result',function(){
    $file = storage_path('exports/enroll.xls');

    if(file_exists($file)){
        return response()->download($file,date('Y',time()).'届敬文新教育录取名单.xls');
    }
});
Route::get('download/word', ['as'=>'download.word','uses'=>'HomeController@getword']);

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    //Route::auth();
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('logout', 'Auth\AuthController@logout');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth.admin'], function () {

    Route::get('home', ['as' => 'admin.home', 'uses' => 'HomeController@index']);
    Route::get('/', ['as' => 'admin.home', 'uses' => 'HomeController@index']);
    Route::resource('users', 'UserController');
    Route::post('users/destroyall',['as'=>'admin.users.destroy.all','uses'=>'UserController@destroyAll']);
    Route::resource('role', 'RoleController');
    Route::post('role/destroyall',['as'=>'admin.role.destroy.all','uses'=>'RoleController@destroyAll']);
    Route::get('role/{id}/permissions',['as'=>'admin.role.permissions','uses'=>'RoleController@permissions']);
    Route::post('role/{id}/permissions',['as'=>'admin.role.permissions','uses'=>'RoleController@storePermissions']);
    Route::resource('permission', 'PermissionController');
    Route::post('permission/destroyall',['as'=>'admin.permission.destroy.all','uses'=>'PermissionController@destroyAll']);
    Route::post('upload/uploadFile',['as'=>'admin.upload.uploadfile','uses'=>'UploadController@uploadFile']);
    Route::post('upload/uploadImage',['as'=>'admin.upload.uploadimage','uses'=>'UploadController@uploadImage']);
    Route::post('upload/deleteFile',['as'=>'admin.upload.deletefile','uses'=>'UploadController@deleteFile']);

    Route::resource('registers', 'RegisterController');
    Route::post('registers/destroyall',['as'=>'admin.registers.destroy.all','uses'=>'RegisterController@destroyAll']);
    Route::get('registers/export/{registers}',['as'=>'admin.registers.export','uses'=>'RegisterController@export']);
    Route::get('exportallexcel',['as'=>'admin.registers.getallexcel','uses'=>'RegisterController@getAllExcel']);
    Route::get('exportall',['as'=>'admin.export.all','uses'=>'RegisterController@exportAll']);
    Route::get('download',['as'=>'admin.download','uses'=>'RegisterController@download']);
    Route::post('registers/check',['as'=>'admin.registers.check','uses'=>'RegisterController@check']);
    Route::post('registers/goinit',['as'=>'admin.registers.goinit','uses'=>'RegisterController@goinit']);
    Route::post('registers/complete',['as'=>'admin.register.complete','uses'=>'RegisterController@complete']);
    Route::post('registers/open',['as'=>'admin.register.open','uses'=>'RegisterController@open']);

    Route::get('upload/import',['as'=>'admin.upload','uses'=>'StudentController@upload']);

    Route::resource('students', 'StudentController');
    Route::post('students/import',['as'=>'admin.students.import','uses'=>'StudentController@import']);
    Route::post('students/destroyall',['as'=>'admin.students.destroy.all','uses'=>'StudentController@destroyAll']);
    Route::get('deleteall',['as'=>'admin.students.delete.all','uses'=>'StudentController@deleteAll']);

    Route::resource('systems', 'SystemController');

});



Route::any('captcha', function()
{
    if (Request::getMethod() == 'POST')
    {
        $rules = ['captcha' => 'required|captcha'];
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails())
        {
            echo '<p style="color: #ff0000;">Incorrect!</p>';
        }
        else
        {
            echo '<p style="color: #00ff30;">Matched :)</p>';
        }
    }

    $form = '<form method="post" action="captcha">';
    $form .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
    $form .= '<p>' . captcha_img() . '</p>';
    $form .= '<p><input type="text" name="captcha"></p>';
    $form .= '<p><button type="submit" name="check">Check</button></p>';
    $form .= '</form>';
    return $form;
});
