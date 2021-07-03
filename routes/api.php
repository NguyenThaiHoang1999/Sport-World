<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/*===============================User==============================*/

Route::post('/sign-up', [UserController::class, 'signUp']); // sign up
Route::post('/sign-in', [UserController::class, 'signIn']); // sign in
Route::post('/sign-out', [UserController::class, 'signOut']); // sign out
Route::post('/user-profile', [UserController::class, 'userProfile']); // signed in user profile
Route::put('/user-profile', [UserController::class, 'updateUserProfile']); // update user profile
Route::get('/verify-email/{email}/{email_token}', [UserController::class, 'verifyEmail']); // signed in user profile
Route::get('/users', [UserController::class, 'getUsers']); // all users
Route::get('/users/{id}', [UserController::class, 'getUserById']); // get user by id
Route::post('/users/{id}', [UserController::class, 'updateStatusUserById']); // update Status User by id


