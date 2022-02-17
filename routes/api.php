<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;

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
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('role/create', [RoleController::class, 'create']);
    Route::get('roles', [RoleController::class, 'index']);
    Route::post('user/role/update', [RoleController::class, 'update_role']);
    Route::get('user/role/remove/{user_id}', [RoleController::class, 'remove_role']);

    Route::get('users', [AuthController::class, 'all_users']);
    Route::get('single/user/{user_id}', [AuthController::class, 'single_users']);
    Route::get('user/profile', [AuthController::class, 'user_profile']);
});










Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
