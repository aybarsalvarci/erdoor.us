<?php

use App\Http\Controllers\Admin\SliderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ================= ADMIN ROUTES =================
Route::prefix('admin/')->name('admin.')->group(function () {

    Route::resource('slider', SliderController::class);
});
