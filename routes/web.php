<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'LoginController@loginForm')->name('login')->middleware('guest');
Route::post('/login', 'LoginController@login')->name('Login');
Route::get('/logout', 'LoginController@logout')->name('logout');

Route::get('/dashboard','UserController@dashboard')->name('dashboard');

// Dasar Hukum
Route::get('/dasarhukum/data','DasarHukumController@dataDasarHukum')->name('dataDasarHukum');
Route::get('/dasarhukum/create','DasarHukumController@createDasarHukum')->name('createDasarHukum');


// Akun
    // Super Admin
    Route::get('/superadmin/data','UserController@dataSuperAdmin')->name('dataSuperAdmin');
    Route::post('/superadmin/insert','UserController@insertSuperAdmin')->name('insertSuperAdmin');
    Route::get('/superadmin/get/{id}','UserController@getSuperAdmin')->name('getSuperAdmin');
    Route::post('/superadmin/update/{id}','UserController@updateSuperAdmin')->name('updateSuperAdmin');
    Route::post('/superadmin/delete/{id}','UserController@deleteSuperAdmin')->name('deleteSuperAdmin');
    // Tim Administratif
    Route::get('/timadministratif/data','UserController@dataTimAdministratif')->name('dataTimAdministratif');
    Route::post('/timadministratif/insert','UserController@insertTimAdministratif')->name('insertTimAdministratif');
    Route::get('/timadministratif/get/{id}','UserController@getTimAdministratif')->name('getTimAdministratif');
    Route::post('/timadministratif/update/{id}','UserController@updateTimAdministratif')->name('updateTimAdministratif');
    Route::post('/timadministratif/delete/{id}','UserController@deleteTimAdministratif')->name('deleteTimAdministratif');
    // Tim Lapangan
    Route::get('/timlapangan/data','UserController@dataTimLapangan')->name('dataTimLapangan');
    Route::post('/timlapangan/insert','UserController@insertTimLapangan')->name('insertTimLapangan');
    Route::get('/timlapangan/get/{id}','UserController@getTimLapangan')->name('getTimLapangan');
    Route::post('/timlapangan/update/{id}','UserController@updateTimLapangan')->name('updateTimLapangan');
    Route::post('/timlapangan/delete/{id}','UserController@deleteTimLapangan')->name('deleteTimLapangan');