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
    Route::get('/superadmin/create','UserController@createSuperAdmin')->name('createSuperAdmin');
    Route::post('/superadmin/insert','UserController@insertSuperAdmin')->name('insertSuperAdmin');