<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SubscriptionController;
use App\Http\Controllers\Backend\AdditionalInfoController;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'));
        });
    Route::get('get_visitors', [DashboardController::class, 'get_visitors'])->name('get_visitors');
    Route::get('get_throughs', [DashboardController::class, 'get_throughs'])->name('get_throughs');
    Route::get('get_methods', [DashboardController::class, 'get_methods'])->name('get_methods');
});

Route::group(['prefix' => 'additionalinfo', 'as' => 'additionalinfo.'], function () {
    Route::get('/', [AdditionalInfoController::class, 'index'])->name('index');
    Route::post('store', [AdditionalInfoController::class, 'store'])->name('store');
});

Route::get('subscribe', [SubscriptionController::class, 'showSubscription'])->name('subscribe');
Route::post('subscribe', [SubscriptionController::class, 'processSubscription'])->name('process_subscribe');
// welcome page only for subscribed users
Route::get('welcome', [SubscriptionController::class, 'showWelcome'])->middleware('subscribed')->name('show_welcome');
