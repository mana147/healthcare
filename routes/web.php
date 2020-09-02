<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

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

Route::get('/', 'UserController@GetDefault');

Route::get('home','UserController@GetHome');

Route::get('kedon', 'UserController@GetKedon');

Route::get('shareinfo', 'UserController@GetShareInfo');

Route::get('logout','UserController@GetLogout');

Route::get('login','UserController@GetLogin');
Route::post('login','UserController@PostLogin');

Route::get('register','UserController@GetRegister');
Route::post('register','UserController@PostRegister');


Route::get('getuserlogin','UserController@GetUserLogin');

Route::post('postid','UserController@PostSearchId');
Route::post('postsokhambenh','UserController@PostSokhambenh');
Route::post('postsavelistid','UserController@PostSaveListId');

// test api
Route::get('getjson','UserController@GetJson');

// Route::get('create_database', 'UserController@Createdatabase');

// Route::get('setdata_sokhambenh', 'UserController@Setdatasokhambenh');

// Route::get('setdata_donthuoc', 'UserController@Setdatadonthuoc');

// Route::get('db',function (){
//     Schema::create('sokhambenh', function ($table   ) {
//         $table->increments('id');
//         $table->string('name', 200);
//     });
//     echo "đã thực hiện tạo bảng database";
// });


// Route::group(['prefix' => 'home','middleware'=>'userLogin'], function () {

// });



Route::get('admin/logout','UserController@GetAdminLogout');
Route::get('admin','UserController@GetAdmin');
Route::get('admin/login','UserController@GetAdminLogin');
Route::post('admin/login','UserController@PostAdminLogin');

Route::group(['prefix' => 'admin','middleware'=>'adminLogin'], function () {
    Route::group(['prefix' => 'user'], function () {

        Route::get('list','UserController@GetList');
        Route::get('delete/{id}','UserController@GetDelete');

        Route::get('add','UserController@GetAdd');
        Route::post('add','UserController@PostAdd');

        Route::get('edit/{id}','UserController@GetEdit');
        Route::post('edit/{id}','UserController@PostEdit');
    });
});

