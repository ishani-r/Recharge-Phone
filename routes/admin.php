<?php

use App\Http\Controllers\Admin\Auth\ImportExportController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Auth'], function () {
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout');
});

Route::group(['middleware' => 'auth:admin'], function () {

    // point
    Route::get('point-list',        'Auth\PointController@pointList')->name('point_list');
    Route::get('send-request',        'Auth\PointController@sendRequest')->name('send_request');
    Route::delete('destroy-Point/{id}',  'Auth\PointController@destroyPoint')->name('destroy_point');
    Route::get('request-status',        'Auth\PointController@requestStatus')->name('request_status');

    Route::get('dashboard/content', function () {
        return view('admin.dashboard.content');
    })->name('main');
    

    // --------------------------------------Admin Profile-------------------------------------------
    Route::put('update-profile/{id}', 'Auth\ProfileController@updateProfile')->name('update_profile');
    Route::get('dashboard/profile', 'Auth\ProfileController@showProfile')->name('showprofile');
    
    // ------------------------------------ change status -----------------------------------------
    Route::get('dashboard/change', 'Auth\ProfileController@changeStatus')->name('changestatus');
    Route::get('details/change', 'Auth\ProfileController@statusChange')->name('statuschange');
    Route::get('dashboard/password', function () {
        return view('admin.dashboard.changepassword');
    })->name('changepassword');
    Route::post('dashboard/changepass/{id}', 'Auth\ProfileController@changePassword')->name('changepass');
    
    // --------------------------------------User Profile-------------------------------------------
    Route::resource('dashboard', Auth\UserController::class)->middleware(['permission:view-user-table']);
    Route::resource('details', Auth\UserDetailsController::class)->middleware(['permission:view-userdetail-table']);
    
    
    
    
    
    // ---------------------------------------- Permission ---------------------------------------
    Route::resource('permission', Auth\PermissionController::class)->middleware(['permission:view-permission-table']);
    Route::post('modulename','Auth\PermissionController@moduleName')->name('modulename');
    
    // ---------------------------------------- Permission ---------------------------------------
    Route::resource('role', Auth\RoleController::class)->middleware(['permission:view-role-table']);
    Route::post('checkname','Auth\RoleController@checkName')->name('checkname');
    
    // ---------------------------------------- Admin ---------------------------------------
    Route::resource('adminuser', Auth\AdminController::class)->middleware(['permission:view-admin-table']);
    
    // Point
    // User Post
    Route::get('list-point',            'Auth\UserPostController@listPoint')->name('list_point');
    Route::get('show-user-list/{id}',            'Auth\UserPostController@showUserList')->name('show_user_list');
    Route::get('list-user',             'Auth\UserPostController@listUser')->name('list_user');
    Route::get('status-user',           'Auth\UserPostController@statusUser')->name('status_user');
    Route::delete('destroy-User/{id}',  'Auth\UserPostController@destroyUser')->name('destroy_user');
});
