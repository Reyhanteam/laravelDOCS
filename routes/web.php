<?php

use App\Http\Controllers\DocumentationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DocumentationController::class, 'home'])->name('home');
Route::get('/docs/search', [DocumentationController::class, 'search'])->name('docs.search');
Route::get('/docs/{path?}', [DocumentationController::class, 'show'])
    ->where('path', '.*')
    ->name('docs.show');
