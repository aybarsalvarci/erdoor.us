<?php

use App\Http\Controllers\Admin\SliderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MediaController;

Route::get('/', function () {
    return view('welcome');
});

// ================= ADMIN ROUTES =================
Route::prefix('admin/')->name('admin.')->group(function () {

    Route::resource('slider', SliderController::class);

    // Media Route
    Route::prefix('/media')->name('media.')->group(function () {
        Route::post('/update-alt', [MediaController::class, 'updateAlt'])->name('update-alt');
        Route::post('/store-url', [MediaController::class, 'storeUrl'])->name('store.url');
        Route::post('/store-file', [MediaController::class, 'storeFile'])->name('store.file');
        Route::get('/fetch-media', [MediaController::class, 'fetchMedia'])->name('fetch');
    });

});
