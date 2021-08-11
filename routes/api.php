<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\AuthController;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});
/*===============================User==============================*/

Route::post('/sign-up', [UserController::class, 'signUp']); // sign up
Route::post('/sign-in', [UserController::class, 'signIn']); // sign in
Route::post('/sign-out', [UserController::class, 'signOut']); // sign out
Route::post('/user-profile', [UserController::class, 'userProfile']); // signed in user profile
Route::put('/user-profile', [UserController::class, 'updateUserProfile']); // update user profile
Route::get('/verify-email/{email}/{email_token}', [UserController::class, 'verifyEmail']); // signed in user profile
Route::get('/users', [UserController::class, 'getUsers']); // all users
Route::get('/users/{id}', [UserController::class, 'getUserProfile']); // get user by id
Route::post('/users/{id}', [UserController::class, 'updateStatusUserById']); // update Status User by id

/*===============================Products==============================*/
Route::get('/products', [ProductController::class, 'getProducts']);
Route::post('/products', [ProductController::class, 'createProduct']);
Route::get('/products/{id}', [ProductController::class, 'getProduct']);
Route::get('/products/category/{id}', [ProductController::class, 'getProductByCategory']);
Route::get('/products/user/{id}', [ProductController::class, 'getProductByUser']);
Route::delete('/products/{id}', [ProductController::class, 'deleteProduct']);
Route::post('/products/search', [ProductController::class, 'searchText']);

/*===============================Notification==============================*/
Route::get('/push-notificaiton', [WebNotificationController::class, 'index'])->name('push-notificaiton');
Route::post('/store-token', [WebNotificationController::class, 'storeToken'])->name('store.token');
Route::post('/send-web-notification', [WebNotificationController::class, 'sendWebNotification'])->name('send.web-notification');
