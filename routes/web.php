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

Route::get('/test', function () {
    return view('registrasi.test');
});

Route::get('/', 'LandingController@test')->name('landing_page')->middleware('guest');
Route::get('/landingdasarhukum', 'LandingController@dasarHukum')->name('dasarhukum')->middleware('guest');
Route::get('/landingdasarhukum/{id}', 'LandingController@getDasarHukum')->name('getDasarhukum')->middleware('guest');
Route::get('/zone_plan', 'LandingController@zone_plan')->name('zone_plan')->middleware('guest');
Route::get('/data_menara', 'LandingController@data_menara')->name('data_menara')->middleware('guest');

// Login 
    Route::get('/login_form', 'LoginController@loginForm')->name('loginForm')->middleware('guest');
    Route::post('/login', 'LoginController@login')->name('Login');
    Route::get('/logout', 'LoginController@logout')->name('logout');

// Registrasi
    Route::get('/registrasi', 'RegistrasiController@registrasiForm')->name('registrasi')->middleware('guest');
    Route::post('/registrasi/insert', 'RegistrasiController@insertRegistrasi')->name('insertRegistrasi')->middleware('guest');
    Route::get('/registrasi/kabupaten/{id}', 'RegistrasiController@getkabupaten')->name('getkabupaten')->middleware('guest');
    Route::get('/registrasi/kecamatan/{id}', 'RegistrasiController@getKecamatan')->name('getKecamatan')->middleware('guest');
    Route::get('/registrasi/desa/{id}', 'RegistrasiController@getDesa')->name('getDesa')->middleware('guest');
    Route::get('/registrasiSukses', 'RegistrasiController@registrasiSukses')->name('registrasiSukses')->middleware('guest');
    Route::get('/verifikasi/{token}', 'RegistrasiController@verifikasi')->name('verifikasi')->middleware('guest');
    Route::get('/verifikasiSukses', 'RegistrasiController@verifikasiSukses')->name('verifikasiSukses')->middleware('guest');

    Route::get('/test', 'RegistrasiController@test')->middleware('guest');
    Route::get('/test2', 'RegistrasiController@test2');
    // Route::get('/verifikasi', 'RegistrasiController@testEmail');
    

// Dashboard 
    Route::get('/dashboard','UserController@dashboard')->name('dashboard');
    
    Route::get('/biodata', 'UserController@biodata')->name('biodata');
    Route::post('/biodata/insert/{id}', 'UserController@insertBiodata')->name('insertBiodata');

    // Dasar Hukum
    Route::get('/dasarhukum/data','DasarHukumController@dataDasarHukum')->name('dataDasarHukum');
    Route::get('/dasarhukum/create','DasarHukumController@createDasarHukum')->name('createDasarHukum');
    Route::post('/dasarhukum/insert','DasarHukumController@insertDasarHukum')->name('insertDasarHukum');
    Route::get('/dasarhukum/detail/{id}','DasarHukumController@detailDasarHukum')->name('detailDasarHukum');
    Route::get('/dasarhukum/download/{id}','DasarHukumController@downloadDasarHukum')->name('downloadDasarHukum');
    Route::get('/dasarhukum/edit/{id}','DasarHukumController@editDasarHukum')->name('editDasarHukum');
    Route::post('/dasarhukum/update/{id}','DasarHukumController@updateDasarHukum')->name('updateDasarHukum');
    Route::post('/dasarhukum/delete/{id}','DasarHukumController@deleteDasarHukum')->name('deleteDasarHukum');

    // Provider
    Route::get('/provider/data','ProviderController@dataProvider')->name('dataProvider');
    Route::post('/provider/insert','ProviderController@insertProvider')->name('insertProvider');
    Route::get('/provider/get/{id}','ProviderController@getProvider')->name('getProvider');
    Route::post('/provider/update/{id}','ProviderController@updateProvider')->name('updateProvider');
    Route::post('/provider/delete/{id}','ProviderController@deleteProvider')->name('deleteProvider');

    // Zone Plan
    Route::get('/zoneplan/data','ZonePlanController@dataZonePlan')->name('dataZonePlan');
    Route::get('/zoneplan/create','ZonePlanController@createZonePlan')->name('createZonePlan');
    Route::post('/zoneplan/insert','ZonePlanController@insertZonePlan')->name('insertZonePlan');
    Route::get('/zoneplan/detail/{id}','ZonePlanController@detailZonePlan')->name('detailZonePlan');
    Route::get('/zoneplan/edit/{id}','ZonePlanController@editZonePlan')->name('editZonePlan');
    Route::post('/zoneplan/update/{id}','ZonePlanController@updateZonePlan')->name('updateZonePlan');
    Route::post('/zoneplan/delete/{id}','ZonePlanController@deleteZonePlan')->name('deleteZonePlan');

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
        // Route::get('/pemilikmenara/data','UserController@dataPemilikMenara')->name('dataPemilikMenara');
        // Route::post('/pemilikmenara/insert','UserController@insertPemilikMenara')->name('insertPemilikMenara');
        // Route::get('/pemilikmenara/validasi/{id}','UserController@validasiPemilikMenara')->name('validasiPemilikMenara');
        // Route::get('/pemilikmenara/validate/{id}','UserController@validatePemilikMenara')->name('validatePemilikMenara');
        // Profile
        Route::get('/profile/admin','UserController@dataProfileAdmin')->name('dataProfileAdmin');
        Route::post('/profile/update/adminUser/{id}','UserController@updateProfileUserAdmin')->name('updateProfileUserAdmin');
        Route::post('/profile/update/adminPassword/{id}','UserController@updateProfilePasswordAdmin')->name('updateProfilePasswordAdmin');

        Route::get('/profile/user','UserController@dataProfileUser')->name('dataProfileUser');
        Route::post('/profile/update/userUser/{id}','UserController@updateProfileUserUser')->name('updateProfileUserUser');
        Route::post('/profile/update/userPassword/{id}','UserController@updateProfilePasswordUser')->name('updateProfilePasswordUser');
        Route::get('/profile/kabupaten/{id}', 'UserController@getkabupaten')->name('getkabupatenUser');
        Route::get('/profile/kecamatan/{id}', 'UserController@getKecamatan')->name('getKecamatanUser');
        Route::get('/profile/desa/{id}', 'UserController@getDesa')->name('getDesaUser');

    // Perusahaan
    Route::get('/perusahaan/data','PerusahaanController@dataPerusahaan')->name('dataPerusahaan');
    Route::get('/perusahaan/detail/{id}','PerusahaanController@detailPerusahaan')->name('detailPerusahaan');
    Route::get('/perusahaan/create','PerusahaanController@createPerusahaan')->name('createPerusahaan');
    Route::post('/perusahaan/insert/{id}','PerusahaanController@insertPerusahaan')->name('insertPerusahaan');
    Route::get('/perusahaan/detailRegistrasi/{id}','PerusahaanController@detailRegistrasi')->name('detailRegistrasi');
    Route::get('/perusahaan/dataRegistrasi','PerusahaanController@dataRegistrasiPerusahaan')->name('dataRegistrasiPerusahaan');
    Route::get('/perusahaan/validasi/{id}','PerusahaanController@validasiPerusahaan')->name('validasiPerusahaan');
    Route::post('/perusahaan/validate/{id}','PerusahaanController@validatePerusahaan')->name('validatePerusahaan');
    Route::get('/perusahaan/edit/{id}','PerusahaanController@editPerusahaan')->name('editPerusahaan');
    Route::post('/perusahaan/update/{id}','PerusahaanController@updateRegistrasi')->name('updateRegistrasi');
    
    // Menara
    Route::get('/menara/data','MenaraController@dataMenara')->name('dataMenara');
    Route::get('/menara/detail/{id}','MenaraController@detailMenara')->name('detailMenara');
    Route::post('/menara/update/{id}','MenaraController@updateMenara')->name('updateMenara');

    // Pengajuan Menara
    Route::get('/pengajuan/data','PengajuanMenaraController@dataPengajuan')->name('dataPengajuan');
    Route::get('/pengajuan/create','PengajuanMenaraController@createPengajuan')->name('createPengajuan');
    Route::post('/pengajuan/insert/{id}','PengajuanMenaraController@insertPengajuan')->name('insertPengajuan');
    Route::get('/pengajuan/draftPengajuan/{id}','PengajuanMenaraController@draftPengajuan')->name('draftPengajuan');
    Route::get('/pengajuan/editDraft/{id}','PengajuanMenaraController@editDraft')->name('editDraft');
    Route::post('/pengajuan/updateDraft/{id}','PengajuanMenaraController@updateDraft')->name('updateDraft');
    Route::get('/pengajuan/deletePendamping/{id}','PengajuanMenaraController@deletePendamping')->name('deletePendamping');
    Route::get('/pengajuan/detailPengajuan/{id}','PengajuanMenaraController@detailPengajuan')->name('detailPengajuan');
    Route::get('/pengajuan/validasiPengajuan/{id}','PengajuanMenaraController@validasiPengajuan')->name('validasiPengajuan');
    Route::post('/pengajuan/validateTimAdministratif/{id}','PengajuanMenaraController@validateTimAdministratif')->name('validateTimAdministratif');
    Route::post('/pengajuan/validateTimLapangan/{id}','PengajuanMenaraController@validateTimLapangan')->name('validateTimLapangan');
    Route::get('/pengajuan/editPengajuan/{id}','PengajuanMenaraController@editPengajuan')->name('editPengajuan');
    Route::post('/pengajuan/updatePengajuan/{id}','PengajuanMenaraController@updatePengajuan')->name('updatePengajuan');
    Route::post('/pengajuan/akhirPengajuan/{id}','PengajuanMenaraController@akhirPengajuan')->name('akhirPengajuan');
    Route::get('/pengajuan/download/{id}','PengajuanMenaraController@downloadFile')->name('downloadFile');


    // Test
    Route::get('/pengajuan/test','PengajuanMenaraController@test');
    Route::post('/pengajuan/insert', 'PengajuanMenaraController@insertTest');