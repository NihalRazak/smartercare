<?php

use App\Http\Controllers\Backend\DashboardController;
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
