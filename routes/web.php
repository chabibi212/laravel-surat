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

Route::group(['prefix' => 'autentikasi'], function(){
    Route::get('/form-login', [
        'uses' => 'Authentication\PenggunaAuthenticationController@loginForm',
        'as' => 'autentikasi.login.form'
    ]);
    Route::post('/login', [
        'uses' => 'Authentication\PenggunaAuthenticationController@login',
        'as' => 'autentikasi.login'
    ]);
    Route::post('/logout', [
        'uses' => 'Authentication\PenggunaAuthenticationController@logout',
        'as' => 'autentikasi.logout'
    ]);
});

Route::group(['middleware' => 'auth:pengguna'], function(){
    Route::get('/', [
        'uses' => 'DashboardController@index',
        'as' => 'dashboard'
    ]);
    Route::group([
        'prefix' => 'unit',
        'middleware' => 'role-super-admin'
    ], function() {
        Route::get('/', [
            'uses' => 'UnitController@index',
            'as' => 'unit'
        ]);
        Route::get('/form-tambah', [
            'uses' => 'UnitController@create',
            'as' => 'unit.form.create'
        ]);
        Route::get('/form-ubah/{id}', [
            'uses' => 'UnitController@edit',
            'as' => 'unit.form.edit'
        ]);
        Route::post('/simpan', [
            'uses' => 'UnitController@store',
            'as' => 'unit.store'
        ]);
        Route::put('/ubah/{id}', [
            'uses' => 'UnitController@update',
            'as' => 'unit.update'
        ]);
        Route::delete('/hapus/{id}', [
            'uses' => 'UnitController@destroy',
            'as' => 'unit.delete'
        ]);
    });
    Route::group(['prefix' => 'kategori',], function() {
        Route::group(['middleware' => 'role-super-admin'], function(){
            Route::get('/', [
                'uses' => 'KategoriController@index',
                'as' => 'kategori'
            ]);
            Route::get('/form-tambah', [
                'uses' => 'KategoriController@create',
                'as' => 'kategori.form.create'
            ]);
            Route::get('/form-ubah/{id}', [
                'uses' => 'KategoriController@edit',
                'as' => 'kategori.form.edit'
            ]);
            Route::post('/simpan', [
                'uses' => 'KategoriController@store',
                'as' => 'kategori.store'
            ]);
            Route::put('/ubah/{id}', [
                'uses' => 'KategoriController@update',
                'as' => 'kategori.update'
            ]);
            Route::delete('/hapus/{id}', [
                'uses' => 'KategoriController@destroy',
                'as' => 'kategori.delete'
            ]);
        });
        Route::group(['prefix' => 'api'], function(){
            Route::get('/cari-Kategori-dari-bagian/{unit_id}', [
                'uses' => 'KategoriController@apiFindKategoriByBagian',
                'as' => 'kategori.api.cari.Kategori.dari.bagian'
            ]);
        });
    });
    Route::group([
        'prefix' => 'pengguna',
        'middleware' => 'role-super-admin'
    ], function() {
        Route::get('/', [
            'uses' => 'PenggunaController@index',
            'as' => 'pengguna'
        ]);
        Route::get('/form-tambah', [
            'uses' => 'PenggunaController@create',
            'as' => 'pengguna.form.create'
        ]);
        Route::get('/form-ubah/{id}', [
            'uses' => 'PenggunaController@edit',
            'as' => 'pengguna.form.edit'
        ]);
        Route::post('/simpan', [
            'uses' => 'PenggunaController@store',
            'as' => 'pengguna.store'
        ]);
        Route::put('/ubah/{id}', [
            'uses' => 'PenggunaController@update',
            'as' => 'pengguna.update'
        ]);
        Route::delete('/hapus/{id}', [
            'uses' => 'PenggunaController@destroy',
            'as' => 'pengguna.delete'
        ]);
    });
    Route::group(['prefix' => 'surat-masuk'], function() {
        Route::get('/', [
            'uses' => 'SuratMasukController@index',
            'as' => 'surat.masuk'
        ]);
        Route::get('/form-tambah', [
            'uses' => 'SuratMasukController@create',
            'as' => 'surat.masuk.form.create'
        ]);
        Route::get('/form-ubah/{id}', [
            'uses' => 'SuratMasukController@edit',
            'as' => 'surat.masuk.form.edit'
        ]);
        Route::get('/kirim-email/{id}', [
            'uses' => 'SuratMasukController@sendEmail',
            'as' => 'surat.masuk.send_email'
        ]);
        Route::post('/simpan', [
            'uses' => 'SuratMasukController@store',
            'as' => 'surat.masuk.store'
        ]);
        Route::put('/ubah/{id}', [
            'uses' => 'SuratMasukController@update',
            'as' => 'surat.masuk.update'
        ]);
        Route::get('/hapus/{id}', [
            'uses' => 'SuratMasukController@destroy',
            'as' => 'surat.masuk.delete'
        ]);
    });
    Route::group(['prefix' => 'surat-keluar'], function() {
        Route::get('/', [
            'uses' => 'SuratKeluarController@index',
            'as' => 'surat.keluar'
        ]);
        Route::get('/form-tambah', [
            'uses' => 'SuratKeluarController@create',
            'as' => 'surat.keluar.form.create'
        ]);
        Route::get('/form-ubah/{id}', [
            'uses' => 'SuratKeluarController@edit',
            'as' => 'surat.keluar.form.edit'
        ]);
        Route::post('/simpan', [
            'uses' => 'SuratKeluarController@store',
            'as' => 'surat.keluar.store'
        ]);
        Route::put('/ubah/{id}', [
            'uses' => 'SuratKeluarController@update',
            'as' => 'surat.keluar.update'
        ]);
        Route::delete('/hapus/{id}', [
            'uses' => 'SuratKeluarController@destroy',
            'as' => 'surat.keluar.delete'
        ]);
    });
    Route::group([
        'prefix' => 'tahap',
        'middleware' => 'role-super-admin'
    ], function() {
        Route::get('/', [
            'uses' => 'TahapController@index',
            'as' => 'tahap'
        ]);
        Route::get('/form-tambah', [
            'uses' => 'TahapController@create',
            'as' => 'tahap.form.create'
        ]);
        Route::get('/form-ubah/{id}', [
            'uses' => 'TahapController@edit',
            'as' => 'tahap.form.edit'
        ]);
        Route::post('/simpan', [
            'uses' => 'TahapController@store',
            'as' => 'tahap.store'
        ]);
        Route::put('/ubah/{id}', [
            'uses' => 'TahapController@update',
            'as' => 'tahap.update'
        ]);
        Route::delete('/hapus/{id}', [
            'uses' => 'TahapController@destroy',
            'as' => 'tahap.delete'
        ]);
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
