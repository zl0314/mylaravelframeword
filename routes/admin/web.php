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

Route::group( [ 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin.auth', 'web' ], function () {

    Route::get( 'my', 'AdminController@my' )->name( 'my.index' );
    Route::post( 'my', 'AdminController@updateInfo' )->name( 'my.store' );
    Route::get( 'chpass', 'AdminController@chpassForm' )->name( 'my.chpass' );
    Route::post( 'chpass', 'AdminController@changePassword' )->name( 'my.storepass' );

    //管理员列表
    Route::resource( 'adminusers', 'AdminUsersController' );

    //角色权限分配
    Route::get( 'roles/permission/{role}', 'RolesController@permission' )->name( 'admin.roles.permisstion' );
    Route::post( 'roles/permission/{role}', 'RolesController@setPermisstion' )->name( 'admin.roles.setPermisstion' );

    Route::resource( 'roles', 'RolesController' );
    Route::resource( 'permissions', 'PermissionsController' );

    //获取权限菜单下子菜单
    Route::post( 'permissions/publicGetSubMenus', 'PermissionsController@getSubMenus' )->name( 'permissions/publicGetSubMenus' );
    Route::get( 'index', 'AdminController@index' )->name( 'admin.index' );
    Route::get( 'info', 'AdminController@info' )->name( 'admin.info' );
    Route::get( 'quite', 'AdminController@quite' )->name( 'admin.quite' );

    //系统设置
    Route::resource( 'setting', 'SettingController' );

    //批量删除
    Route::post( 'batchDel/{model}', 'BatchController@delete' );
} );


Route::group( [ 'prefix' => 'admin', 'namespace' => 'Admin' ], function () {
    Route::get( 'login', 'LoginController@index' );
    Route::post( 'login', 'LoginController@dologin' );
} );
