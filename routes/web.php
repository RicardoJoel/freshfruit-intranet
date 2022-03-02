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

Auth::routes(['verify' => true]);

Route::group([
    'middleware' => 'guest',
], function () {
    Route::get('/', function () { return view('index'); });
    Route::get('verify', function () { return view('auth.verify'); });  
    Route::get('activate/{code}', 'UserController@activate');
    Route::post('complete/{id}', 'UserController@complete');
    Route::get('manifests.dataEvol', 'ManifestController@dataEvol')->name('manifests.dataEvol');
    Route::get('manifests.dataPais', 'ManifestController@dataPais')->name('manifests.dataPais');
    Route::get('manifests.dataExpo', 'ManifestController@dataExpo')->name('manifests.dataExpo');
    Route::get('manifests.dataEvolDia', 'ManifestController@dataEvolDia')->name('manifests.dataEvolDia');
    Route::get('manifests.dataEvolSem', 'ManifestController@dataEvolSem')->name('manifests.dataEvolSem');
    Route::get('manifests.dataEvolMes', 'ManifestController@dataEvolMes')->name('manifests.dataEvolMes');
});

Route::group([
    'middleware' => 'verified',
], function () {
    Route::get('profile', function () { return view('auth.profile'); })->name('profile');
    Route::get('password', function () { return view('auth.passwords.update'); })->name('password');
    Route::post('updateAccount', 'UserController@updateAccount');
    Route::post('changePassword', 'Auth\ChangePasswordController@store');
    Route::get('manifests.charts', 'ManifestController@charts')->name('manifests.charts');
    Route::get('manifests.report', 'ManifestController@report')->name('manifests.report');
    Route::get('manifests.generate', 'ManifestController@generate')->name('manifests.generate');
    Route::get('manifests.download', 'ManifestController@download')->name('manifests.download');
    Route::get('manifests.dataEvolVer', 'ManifestController@dataEvol')->name('manifests.dataEvolVer');
    Route::get('manifests.dataPaisVer', 'ManifestController@dataPais')->name('manifests.dataPaisVer');
    Route::get('manifests.dataExpoVer', 'ManifestController@dataExpo')->name('manifests.dataExpoVer');
    Route::get('manifests.dataEvolDiaVer', 'ManifestController@dataEvolDia')->name('manifests.dataEvolDiaVer');
    Route::get('manifests.dataEvolSemVer', 'ManifestController@dataEvolSem')->name('manifests.dataEvolSemVer');
    Route::get('manifests.dataEvolMesVer', 'ManifestController@dataEvolMes')->name('manifests.dataEvolMesVer');
    Route::get('manifests.countries', 'ManifestController@countries')->name('manifests.countries');
    Route::get('manifests.shippers', 'ManifestController@shippers')->name('manifests.shippers');
    Route::get('manifests.consignees', 'ManifestController@consignees')->name('manifests.consignees');
});

Route::group([
    'middleware' => 'isnt_admin',
], function () {
    Route::get('home', 'ManifestController@report')->name('home');
});

Route::group([
    'middleware' => 'is_admin',
    'prefix' => 'admin'
], function () {
    Route::get('home', 'HomeController@adminHome')->name('home');
    Route::resource('users', 'UserController');
});