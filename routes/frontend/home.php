<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AnalyticsController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\ServicesController;
use App\Http\Controllers\Frontend\YourSmarterChoiceController;
use App\Http\Controllers\Frontend\SmartSizedController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\SubscriptionController;
use App\Http\Controllers\Frontend\AdditionalInfoController;
use App\Http\Controllers\Frontend\PrivacyController;
use App\Http\Controllers\Frontend\TermsController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', [HomeController::class, 'index'])
    ->name('index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('frontend.index'));
    });

Route::post('zip_codes', [HomeController::class, 'get_zip_codes'])->name('zip_codes');
Route::post('providers', [HomeController::class, 'get_providers'])->name('providers');


Route::post('count_visitor', [AnalyticsController::class, 'count_visitor'])->name('count_visitor');
Route::post('count_through', [AnalyticsController::class, 'count_through'])->name('count_through');
Route::post('count_method', [AnalyticsController::class, 'count_method'])->name('count_method');


Route::get('/search', [SearchController::class, 'index'])
    ->name('pages.search');

Route::get('/services', [ServicesController::class, 'index'])
    ->name('pages.services');

Route::get('/360-your-smarter-choice', [YourSmarterChoiceController::class, 'index'])
    ->name('pages.your_smarter_choice');

Route::get('/smart-sized', [SmartSizedController::class, 'index'])
    ->name('pages.smartsized');

Route::get('/about', [AboutController::class, 'index'])
    ->name('pages.about');
    
Route::get('/privacy', [PrivacyController::class, 'index'])
    ->name('pages.privacy');

Route::get('/terms', [TermsController::class, 'index'])
    ->name('pages.terms');

Route::group(['prefix' => 'subscribe', 
                'as' => 'subscribe.', 
                'middleware' => 'auth'], function () {
    Route::get('/', [SubscriptionController::class, 'showSubscription'])->name('subscribe');
    Route::post('/', [SubscriptionController::class, 'processSubscription'])->name('process_subscribe');
});

Route::group(['prefix' => 'additionalinfo', 'as' => 'additionalinfo.'], function () {
    Route::get('/', [AdditionalInfoController::class, 'index'])->name('index');
    Route::post('store', [AdditionalInfoController::class, 'store'])->name('store');
});

Route::get('/search/{company}', [SearchController::class, 'company'])
    ->name('pages.companyPage');