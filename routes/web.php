<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\StorePageController;

Route::redirect('/', '/stores');

Route::get('/stores', [StorePageController::class, 'index']);
Route::get('/stores/{id}', [StorePageController::class, 'show']);