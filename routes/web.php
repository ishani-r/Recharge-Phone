<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Front\PostController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Post
Route::post('add-post', [PostController::class, 'createPost'])->name('add_post');
Route::post('send-request', [PostController::class, 'sendRequest'])->name('send_request');
Route::post('title-name',  [PostController::class, 'titleName'])->name('title_name');
// Route::post('request-status',        [PostController::class, 'requestStatus'])->name('request_status');

