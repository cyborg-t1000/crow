<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaterkitController;
use App\Http\Controllers\LanguageController;

Auth::routes([
    'reset' => false,
    'verify' => false,
    'register' => false,
]);

Route::group(['middleware' => 'auth'], function()
{
    Route::get('/', [StaterkitController::class, 'home'])->name('home');
    Route::get('home', [StaterkitController::class, 'home'])->name('home');
    // Route Components
    Route::get('layouts/collapsed-menu', [StaterkitController::class, 'collapsed_menu'])->name('collapsed-menu');
    Route::get('layouts/full', [StaterkitController::class, 'layout_full'])->name('layout-full');
    Route::get('layouts/without-menu', [StaterkitController::class, 'without_menu'])->name('without-menu');
    Route::get('layouts/empty', [StaterkitController::class, 'layout_empty'])->name('layout-empty');
    Route::get('layouts/blank', [StaterkitController::class, 'layout_blank'])->name('layout-blank');
    
    Route::get('orders', [StaterkitController::class, 'orders'])->name('orders');
    Route::get('orders/{order_id}', [StaterkitController::class, 'detail'])->name('orders.detail');
});

// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);
