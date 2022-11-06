<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'status'], function () {
    Route::get('store_avilability_zone', [App\Http\Controllers\Api\InstancesController::class,'instances'])->name('instances');;
    Route::put('store_avilability_zone/{instance_id}', [App\Http\Controllers\Api\InstancesController::class,'instance'])->name('instance');
    Route::put('store_avilability_zone/{instance_id}/{availability_zone}', [App\Http\Controllers\Api\InstancesController::class,'store_avilability_zone'])->name('store_avilability_zone');
   
    Route::get('view_zone_history', [App\Http\Controllers\Api\InstancesController::class,'availibility_zones'])->name('availibility_zones');
    Route::get('view_zone_history/{availability_zone}', [App\Http\Controllers\Api\InstancesController::class,'view_zone_history'])->name('view_zone_history');
});