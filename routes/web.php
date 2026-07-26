<?php

use App\Http\Controllers\Admin\DoorController;
use App\Http\Controllers\Admin\DoorSpesificationController;
use App\Http\Controllers\Admin\DoorVariantController;
use App\Http\Controllers\Admin\SliderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MediaController;

Route::get('/', function () {
    return view('welcome');
});

// ================= ADMIN ROUTES =================
Route::prefix('admin/')->name('admin.')->group(function () {

    // Media Route
    Route::prefix('/media')->name('media.')->group(function () {
        Route::post('/update-alt', [MediaController::class, 'updateAlt'])->name('update-alt');
        Route::post('/store-url', [MediaController::class, 'storeUrl'])->name('store.url');
        Route::post('/store-file', [MediaController::class, 'storeFile'])->name('store.file');
        Route::get('/fetch-media', [MediaController::class, 'fetchMedia'])->name('fetch');
    });

    Route::resource('slider', SliderController::class);
    Route::resource('door', DoorController::class);
    Route::resource('door.variant', DoorVariantController::class)->only(['store', 'destroy']);
    Route::resource('door.spesification', DoorSpesificationController::class)->only(['store', 'destroy']);
});
