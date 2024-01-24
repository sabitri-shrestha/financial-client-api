<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FinancialController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them willfailed_jobs
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('financial-app.index');
    }
    return Inertia::render('Auth/Login');
})->name('login');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/financial-app', [FinancialController::class, 'index'])->name('financial-app.index');
    Route::get('/financial-app/company-profile/{symbol}', [FinancialController::class, 'getCompanyProfile'])->name('financial-app.company-profile');
    Route::get('/financial-app/company-quote/{symbol}', [FinancialController::class, 'getCompanyQuote'])->name('financial-app.company-quote');
    Route::post('/financial-app/export', [FinancialController::class, 'export'])->name('search.export');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class,'logout'])->name('logout');


