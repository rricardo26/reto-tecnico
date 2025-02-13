<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RegisterSaleController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SalesExportJsonController;
use App\Http\Controllers\SalesExportXlsxController;


Route::post('register', RegisterController::class);
Route::post('login', LoginController::class);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::resource('products', ProductController::class);
    Route::post('register-sale', RegisterSaleController::class);

    Route::group(['middleware' => 'can:Exports'], function () {
        Route::post('sales-export-json', SalesExportJsonController::class);
        Route::post('sales-export-xlsx', SalesExportXlsxController::class);
    });
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
