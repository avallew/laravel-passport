<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\TenantController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('web')->group(
    function () {
        // Route::apiResource('users', UserController::class);
        // Route::get('user', [UserController::class, 'user']);
        Route::apiResource('tenants', TenantController::class);
        Route::apiResource('permissions', PermissionController::class);
        Route::apiResource('roles', RoleController::class);
        Route::post('permissions-to-role/{role}', [RoleController::class,'permissionsToRole']);
        Route::post('roles-to-user/{user}', [RoleController::class,'rolesToUser']);
        // Route::post('logout', [AuthController::class, 'logout']);
    }
);

// Route::middleware('web')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/foo', function () {
    // ...
})->middleware(['universal', InitializeTenancyByDomain::class]);
