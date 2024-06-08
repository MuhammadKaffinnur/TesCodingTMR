<?php

use App\Http\Controllers\Api\WilayahController;
use Illuminate\Http\Request;
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

Route::get('provinces', [WilayahController::class, 'provinces']);
Route::get('provinces/{provinceId}/regencies', [WilayahController::class, 'regencies']);
Route::get('regencies/{regencyId}/districts', [WilayahController::class, 'districts']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
