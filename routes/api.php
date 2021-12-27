<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ForgotPasswordController;
use App\Http\Controllers\API\AuthApiController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\RechargeController;
use App\Http\Controllers\API\PointController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// -------------------------- User --------------------------
Route::post('login',                [LoginController::class, 'login']);
Route::post('insertuser',           [UserController::class, 'store']);
Route::get('showuser/{id?}',        [UserController::class, 'show']);
Route::put('updateuser/{id}',       [UserController::class, 'update']);
Route::delete('deleteuser/{id}',    [UserController::class, 'destroy']);

// ---------------------------------------- Mail ---------------------------------------
Route::post('sendmail', [ForgotPasswordController::class, 'sendMail']);
Route::post('otpsend', [ForgotPasswordController::class, 'otpSend']);

Route::post('createToken', [AuthApiController::class, 'createToken']);
Route::group(['middleware' => 'AuthenticateApi'], function () {
    // Route::post('friend-details', 'Api\UserController@friendDetails');
});

Route::group(['middleware' => 'auth:api'], function () {

    // Post
    Route::post('createPost',           [PostController::class, 'createPost']);
    Route::post('sendRequest',           [PostController::class, 'sendRequest']);

    // Recharge
    Route::get('showRechargeHistory/{id?}',    [RechargeController::class, 'showRechargeHistory']);

    // Point
    Route::get('showPoint/{id}',     [PointController::class, 'showPoint']);

});
