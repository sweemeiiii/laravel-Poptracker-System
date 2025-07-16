<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\FigurineController;
use App\Http\Controllers\WishlistController;
use Illuminate\View\View;


Route::get('/', function (): View {
    return view('welcome');
});

// Override Fortify Login and Logout
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function (): View {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});

Route::resource('user', UserController::class);

Route::middleware(['auth'])->group(function () {
    Route::resource('figurines', FigurineController::class);
});

Route::get('/figurines/{figurine}', [FigurineController::class, 'show'])->name('figurines.show');

Route::middleware(['auth'])->group(function () {
    Route::resource('wishlists', WishlistController::class)->only(['index', 'store', 'destroy']);
});

Route::resource('wishlists', WishlistController::class);

use App\Http\Controllers\OwnedController;
use App\Http\Controllers\DuplicateController;

// Owned Figurines
Route::get('/owned', [OwnedController::class, 'index'])->name('owned.index');
Route::post('/owned', [OwnedController::class, 'store'])->name('owned.store');
Route::delete('/owned/{figurine}', [OwnedController::class, 'destroy'])->name('owned.destroy');

// Duplicate Figurines
Route::get('/duplicates', [DuplicateController::class, 'index'])->name('duplicates.index');
Route::post('/duplicates', [DuplicateController::class, 'store'])->name('duplicates.store');
Route::delete('/duplicates/{figurine}', [DuplicateController::class, 'destroy'])->name('duplicates.destroy');

use App\Http\Controllers\ProgressController;
Route::get('/progress', [ProgressController::class, 'index'])->name('progress.index');

Route::get('/map', function () {
    return view('map.index');
})->name('map.index');

use App\Http\Controllers\ChatbotController;

Route::post('/chatbot/ask', [ChatbotController::class, 'ask'])->name('chatbot.ask');

use App\Http\Controllers\BarcodeScannerController;
Route::get('/barcode-scan', [BarcodeScannerController::class, 'scanPage'])->name('barcode.scan');
Route::get('/barcode-lookup/{barcode}', [BarcodeScannerController::class, 'getFigurineByBarcode']);