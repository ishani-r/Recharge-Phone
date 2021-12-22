<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LoginController;
// use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\UserDetailsController;
use App\Http\Controllers\API\LikeController;
use App\Http\Controllers\API\PremiumController;
use App\Http\Controllers\API\SettingController;
use App\Http\Controllers\API\MessageController;
use App\Http\Controllers\API\HelpController;
use App\Http\Controllers\API\FollowController;
use App\Http\Controllers\API\ForgotPasswordController;
use App\Http\Controllers\API\AuthApiController;

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
// Route::post('insertuser',           [UserController::class, 'store']);
// Route::get('showuser/{id?}',        [UserController::class, 'show']);
// Route::put('updateuser/{id}',       [UserController::class, 'update']);
// Route::delete('deleteuser/{id}',    [UserController::class, 'destroy']);

// ---------------------------------------- Mail ---------------------------------------
Route::post('sendmail', [ForgotPasswordController::class, 'sendMail']);
Route::post('otpsend', [ForgotPasswordController::class, 'otpSend']);

Route::post('createToken', [AuthApiController::class, 'createToken']);
Route::group(['middleware' => 'AuthenticateApi'], function () {
    // Route::post('friend-details', 'Api\UserController@friendDetails');
});

Route::group(['middleware' => 'auth:api'], function () {
    // -------------------------- User Detail -------------------------
    Route::post('insertuserdetail', [UserDetailsController::class, 'store']);
    Route::get('showuserdetail/{id?}', [UserDetailsController::class, 'show']);
    Route::put('updateuserdetail/{id}', [UserDetailsController::class, 'update']);
    Route::delete('deleteuserdetail/{id}', [UserDetailsController::class, 'destroy']);

    // -------------------------------------- Like ----------------------------
    Route::post('likeinsert', [LikeController::class, 'like']);
    Route::get('shownotification', [LikeController::class, 'showNotification']);

    // -------------------------------------- Distance ----------------------------
    Route::post('userdistance', [UserDetailsController::class, 'distance']);

    // -------------------------------------- Premium ----------------------------
    Route::post('insertpremium', [PremiumController::class, 'store']);
    Route::put('updatepremium/{id}', [PremiumController::class, 'update']);
    Route::delete('deletepremium/{id}', [PremiumController::class, 'destroy']);

    // -------------------------------------- Setting ----------------------------
    Route::post('insertsetting', [SettingController::class, 'store']);
    Route::put('updatesetting/{id}', [SettingController::class, 'update']);
    Route::delete('deletesetting/{id}', [SettingController::class, 'destroy']);

    // -------------------------------------- Message ----------------------------
    Route::post('sendmessage', [MessageController::class, 'store']);
    Route::get('showmessage', [MessageController::class, 'show']);

    // -------------------------------------- Help ----------------------------
    Route::get('showanswer', [HelpController::class, 'show']);
    Route::post('contect', [HelpController::class, 'store']);

    // -------------------------------------- Follow ----------------------------
    Route::post('sendrequest', [FollowController::class, 'sendRequest']);
    Route::get('showrequest', [FollowController::class, 'showRequest']);
    Route::post('acceptrequest', [FollowController::class, 'acceptRequest']);
});
