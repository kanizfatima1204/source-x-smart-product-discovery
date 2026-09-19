<?php

use App\Http\Controllers\ProductDiscoveryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductDiscoveryController::class, 'index'])->name('discovery.index');
Route::get('/products/{product}', [ProductDiscoveryController::class, 'show'])->name('products.show');
