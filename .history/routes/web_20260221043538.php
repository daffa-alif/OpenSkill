<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController, SeminarController, WebinarController, ExploreController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ──────────────────────────────────────────────
// Root redirect
// ──────────────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
});


// ──────────────────────────────────────────────
// Guest routes (only accessible when NOT logged in)
// ──────────────────────────────────────────────
Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);

    // Register
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register']);
});

// ──────────────────────────────────────────────
// Authenticated routes (only accessible when logged in)
// ──────────────────────────────────────────────
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [AuthController::class, 'welcome'])
        ->name('profile.welcome');

    Route::put('/profile', [AuthController::class, 'update'])
        ->name('profile.update');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/webinar', [WebinarController::class, 'index'])->name('webinar');

    Route::get('/seminar', [SeminarController::class, 'index'])->name('seminar');

    Route::get('/explore', [ExplorerController::class, 'index'])->name('explore');
});