<?php

/* Statement for dump raw query from eloquent */
// DB::listen(function ($query) { var_dump($query->sql, $query->bindings); });

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ChartController;


/*
 * Global Routes
 * Routes that are used between both frontend and backend.
 */

// Switch between the included languages
Route::get('lang/{lang}', [LanguageController::class, 'swap']);

/*
 * Frontend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    include_route_files(__DIR__.'/frontend/');
});

/*
 * Backend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    /*
     * These routes need view-backend permission
     * (good if you want to allow more than one group in the backend,
     * then limit the backend features by different roles or permissions)
     *
     * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
     * These routes can not be hit if the password is expired
     */
    include_route_files(__DIR__.'/backend/');
});


    // Client Management - with needed permissions
    Route::group(['middleware' => 'role:'.config('access.users.admin_role')], function () {

        // Client CRUD 
        Route::get('clients-management', [ClientController::class, 'management'])->name('clients-management.index');
        Route::patch('clients/{client}', 'ClientController@update')->name('update');
        Route::post('categoryTag', [ClientController::class, 'categoryTag'])->name('clients.categoryTag');

        // Categories & Tags Management
        Route::get('categories-tags', function () {
            return view('backend/categories-tags');
        })->name('categories-tags.index');

        // Categories
        Route::get('api/categories', [CategoryController::class, 'index'])->name('api/categories.index');
        Route::post('api/categories', [CategoryController::class, 'store'])->name('api/categories.store');
        Route::patch('api/update/categories', [CategoryController::class, 'update'])->name('api/categories.update');
        Route::delete('api/categories/{category}', [CategoryController::class, 'destroy'])->name('api/categories.destroy');

        // Tags
        Route::get('api/tags', [TagController::class, 'index'])->name('api/tags.index');
        Route::post('api/tags', [TagController::class, 'store'])->name('api/tags.store');
        Route::patch('api/update/tags', [TagController::class, 'update'])->name('api/tags.update');
        Route::delete('api/tags/{tag}', [TagController::class, 'destroy'])->name('api/tags.destroy');
    });

    Route::group(['middleware' => 'auth'], function () {

        // Client CRUD
        Route::get('clients', [ClientController::class, 'index'])->name('clients.index');
        Route::get('filter-clients', [ClientController::class, 'filterClients'])->name('clients.filterClients');

        /* Charts APi's */
        Route::get('admin/api/city', 'ChartController@clientsByCity');
        Route::get('admin/api/gender', 'ChartController@clientsByGender');
        Route::get('admin/api/top-ten', 'ChartController@topTen');
        Route::get('admin/api/age', 'ChartController@clientsByAge');
        Route::get('admin/api/estimate', 'ChartController@estimateByCategory');
        Route::get('admin/locations/growth', 'LocationController@growth')->name('locations.growth');

        /* Locations APi's */
    Route::get('locations', 'LocationController@index')->name('locations.index');

    Route::get('test', 'LocationController@test')->name('locations.test');
});







