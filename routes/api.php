<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('website/create', [WebsiteController::class, 'createNewWebsite'])->name('api.create.website');

Route::post('post/create', [PostController::class, 'createNewPost'])->name('api.create.post');

Route::post('add_website_user', [WebsiteController::class, 'addWebsiteUser'])->name('api.user.website');

Route::post('add_user', [UserController::class, 'addUser'])->name('api.user.store');

Route::get('websites', [WebsiteController::class, 'list'])->name('api.get.websites');
