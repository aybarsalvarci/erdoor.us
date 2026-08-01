<?php

use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DoorController;
use App\Http\Controllers\Admin\DoorSertificationController;
use App\Http\Controllers\Admin\DoorSpesificationController;
use App\Http\Controllers\Admin\DoorVariantController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ResourceController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MediaController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Admin\PageManagementController;
use App\Http\Controllers\AuthController;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get(LaravelLocalization::transRoute('routes.door-single'), [HomeController::class, 'doorSingle'])->name('door-single');
    Route::get(LaravelLocalization::transRoute('routes.resources.main'), [HomeController::class, 'resources'])->name('resources');
    Route::get(LaravelLocalization::transRoute('routes.resources.single'), [HomeController::class, 'resourcesSingle'])->name('resources.single');
    Route::get(LaravelLocalization::transRoute('routes.why-wpc-doors'), [HomeController::class, 'whyWpcDoors'])->name('why-wpc-doors');
    Route::get(LaravelLocalization::transRoute('routes.about'), [HomeController::class, 'about'])->name('about');
    Route::get(LaravelLocalization::transRoute('routes.contact'), [HomeController::class, 'contact'])->name('contact');

    Route::middleware('guest')->group(function(){
        Route::get(LaravelLocalization::transRoute('routes.login'), [AuthController::class, 'loginView'])->name('login');
        Route::post(LaravelLocalization::transRoute('routes.login'), [AuthController::class, 'login'])->name('login');
    });

});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::post('/send-contact', [HomeController::class, 'sendContact'])->name('send-contact');

// ================= ADMIN ROUTES =================
Route::prefix('admin/')->name('admin.')->middleware('auth')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

//     Media Route
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
    Route::resource('contact-message', ContactMessageController::class)->only(['index', 'show', 'destroy']);
    // Door certifications
    Route::put('/door-certification/text-update/{id}', [DoorSertificationController::class, 'updateText'])->name('door.sertification_texts.update');
    Route::post('/door-certification/store-sertificate/{id}', [DoorSertificationController::class, 'storeSertificate'])->name('door.sertificate.store');
    Route::delete('/door-certification/delete/{id}', [DoorSertificationController::class, 'destroy'])->name('door.sertificate.destroy');

    //  ======= PAGE MANAGEMENT ROUTES =======
    // 1 - Manage HomePage
    Route::get('/manage-homepage', [PageManagementController::class, 'manageHomePage'])->name('manage-homepage');
    Route::put('/manage-homepage', [PageManagementController::class, 'updateHomePage'])->name('pages.home.update');

    // 2 - Manage Why WPC Door Page
    Route::get('/manage-why-wpc-door', [PageManagementController::class, 'manageWhyWPC'])->name('pages.why-wpc-door');
    Route::put('/manage-why-wpc-door', [PageManagementController::class, 'updateWhyWPC'])->name('pages.why_wpc.update');

    // 3 - Manage About Page
    Route::get('/manage-about-us', [PageManagementController::class, 'manageAboutUs'])->name('pages.about-us');
    Route::put('/manage-about-us', [PageManagementController::class, 'updateAboutUs'])->name('pages.about.update');

    // 4 - Manage Contact Page
    Route::get('/manage-contact-us', [PageManagementController::class, 'manageContactUs'])->name('pages.contact-us');
    Route::put('/manage-contact-us', [PageManagementController::class, 'updateContactUs'])->name('pages.contact.update');


    //  ======= RESOURCE ROUTES =======

    Route::prefix('/resources')->name('resources.')->group(function () {
        //  1 - Installation Page Routes
        Route::get('/installation-page', [ResourceController::class, 'installationPage'])->name('installation-page');
        Route::put('/installation-page', [ResourceController::class, 'updateInstallationPage'])->name('installation.update');

        //  2 - Fire Resistence Test Page Routes
        Route::get('/fire-resistence-test-page', [ResourceController::class, 'fireResistenceTest'])->name('fire-resistence-test-page');
        Route::put('/fire-resistence-test-page', [ResourceController::class, 'updateFireResistenceTest'])->name('fire_resistance.update');

        //  3 - Warranty Page Routes
        Route::get('/warranty-page', [ResourceController::class, 'warrantyPage'])->name('warranty-page');
        Route::put('/warranty-page', [ResourceController::class, 'updateWarrantyPage'])->name('warranty.update');

        //  3 - Technical Certificates Page Routes
        Route::get('/technical-certificates', [ResourceController::class, 'technicalCertificatesPage'])->name('technicalCertificatesPage');
        Route::put('/technical-certificates', [ResourceController::class, 'updateTechnicalCertificatesPage'])->name('technical_certificates.update');

        Route::resource('certificates', \App\Http\Controllers\Admin\CertificateController::class);

        // 4 - Gallery Routes
        Route::get('/gallery', [ResourceController::class, 'galleryPage'])->name('galleryPage');
        Route::put('/gallery', [ResourceController::class, 'updateGalleryPage'])->name('galleryPage.update');

        //  5 - Digital Catalog Page Routes
        Route::get('/catalog-page', [ResourceController::class, 'catalogPage'])->name('catalog-page');
        Route::put('/catalog-page', [ResourceController::class, 'updateCatalogPage'])->name('digital_catalog.update');

        //  5 - Gallery Content Management Routes
        Route::get('/gallery-management', [GalleryController::class, 'index'])->name('gallery.index');
        Route::post('/gallery/store', [GalleryController::class, 'store'])->name('gallery.store');
        Route::delete('/gallery/destroy/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');
    });

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');

});
