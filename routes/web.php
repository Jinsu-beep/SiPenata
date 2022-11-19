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

Route::get('/landing', function () {
    return view('test.home');
});

Route::get('/', 'LandingController@test')->name('landing_page')->middleware('guest');
Route::get('/zone_plan', 'LandingController@zone_plan')->name('zone_plan')->middleware('guest');
Route::get('/data_menara', 'LandingController@data_menara')->name('data_menara')->middleware('guest');

// Login 
    Route::get('/login_form', 'LoginController@loginForm')->name('loginForm')->middleware('guest');
    Route::post('/login', 'LoginController@login')->name('Login');
    Route::get('/logout', 'LoginController@logout')->name('logout');

// Registrasi 
    // Route::get('/pilihRole', 'RegistrasiController@registrasiRole')->name('pilihRole')->middleware('guest');
    Route::get('/registrasiPemilikMenara', 'RegistrasiController@registrasiPemilikMenaraForm')->name('registrasiPemilikMenara')->middleware('guest');
    Route::post('/regisPemilikMenara', 'RegistrasiController@insertRegistrasiPemilikMenara')->name('insertRegistrasiPemilikMenara')->middleware('guest');
    Route::get('/registrasiSukses', 'RegistrasiController@registrasiSukses')->name('registrasiSukses')->middleware('guest');

// Dashboard 
    Route::get('/dashboard','UserController@dashboard')->name('dashboard');

    // Dasar Hukum
    Route::get('/dasarhukum/data','DasarHukumController@dataDasarHukum')->name('dataDasarHukum');
    Route::get('/dasarhukum/create','DasarHukumController@createDasarHukum')->name('createDasarHukum');
    Route::post('/dasarhukum/insert','DasarHukumController@insertDasarHukum')->name('insertDasarHukum');
    Route::get('/dasarhukum/detail/{id}','DasarHukumController@detailDasarHukum')->name('detailDasarHukum');

    // Akun
        // Super Admin
        Route::get('/superadmin/data','UserController@dataSuperAdmin')->name('dataSuperAdmin');
        Route::post('/superadmin/insert','UserController@insertSuperAdmin')->name('insertSuperAdmin');
        Route::get('/superadmin/get/{id}','UserController@getSuperAdmin')->name('getSuperAdmin');
        Route::post('/superadmin/update/{id}','UserController@updateSuperAdmin')->name('updateSuperAdmin');
        Route::post('/superadmin/delete/{id}','UserController@deleteSuperAdmin')->name('deleteSuperAdmin');
        // Admin
        Route::get('/admin/data','UserController@dataAdmin')->name('dataAdmin');
        Route::post('/admin/insert','UserController@insertAdmin')->name('insertAdmin');
        Route::get('/admin/get/{id}','UserController@getAdmin')->name('getAdmin');
        Route::post('/admin/update/{id}','UserController@updateAdmin')->name('updateAdmin');
        Route::post('/admin/delete/{id}','UserController@deleteAdmin')->name('deleteAdmin');
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
        // Pemilik Menara
        Route::get('/pemilikmenara/data','UserController@dataPemilikMenara')->name('dataPemilikMenara');
        Route::post('/pemilikmenara/insert','UserController@insertPemilikMenara')->name('insertPemilikMenara');
        // Profile
        Route::get('/profile/admin','UserController@dataProfileAdmin')->name('dataProfileAdmin');
        Route::get('/profile/edit/admin','UserController@editProfileAdmin')->name('editProfileAdmin');
        Route::post('/profile/update/admin/{id}','UserController@updateProfileAdmin')->name('updateProfileAdmin');

        Route::get('/profile/user','UserController@dataProfileUser')->name('dataProfileUser');
        Route::get('/profile/edit/user','UserController@editProfileUser')->name('editProfileUser');
        Route::post('/profile/update/user/{id}','UserController@updateProfileUser')->name('updateProfileUser');

    // Menara
    Route::get('/menara/data','MenaraController@dataMenara')->name('dataMenara');

    // Pengajuan Menara
    Route::get('/pengajuan/data','PengajuanMenaraController@dataPengajuan')->name('dataPengajuan');