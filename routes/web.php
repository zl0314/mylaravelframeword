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

include_once __DIR__ . '/admin/web.php';

Route::get( '/captcha/{random}', 'CaptchaController@code' );
//上传
Route::post( '/upload', 'UploadController@upload' );

Route::group( [ 'middleware' => 'web' ], function () {
    Route::get( '/', 'IndexController@index' );
} );
