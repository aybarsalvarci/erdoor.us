<?php

use App\Http\Controllers\Admin\DoorController;
use App\Http\Controllers\Admin\DoorSertificationController;
use App\Http\Controllers\Admin\DoorSpesificationController;
use App\Http\Controllers\Admin\DoorVariantController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MediaController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function() {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get(LaravelLocalization::transRoute('routes.door-single'), [HomeController::class, 'doorSingle'])->name('door-single');
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

    Route::resource('door', DoorController::class);
    Route::resource('slider', SliderController::class);
    Route::resource('door.variant', DoorVariantController::class)->only(['store', 'destroy']);
    Route::resource('door.spesification', DoorSpesificationController::class)->only(['store', 'destroy']);

    // Door certifications
    Route::put('/door-certification/text-update/{id}', [DoorSertificationController::class, 'updateText'])->name('door.sertification_texts.update');
    Route::post('/door-certification/store-sertificate/{id}', [DoorSertificationController::class, 'storeSertificate'])->name('door.sertificate.store');
    Route::delete('/door-certification/delete/{id}', [DoorSertificationController::class, 'destroy'])->name('door.sertificate.destroy');
});
