<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');



Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/my-profile', [ProfileController::class, 'index'])->name('my-profile');

Route::post('/my-profile', [ProfileController::class, 'createProfile'])->name('createProfile');

Route::post('/my-profile/update', [ProfileController::class, 'updateProfile'])->name('updateProfile');


// Settings Page
Route::get('/settings', 'SettingsController@index')->name('settings');

// Password Change
Route::get('/settings/password', [SettingsController::class, 'showPasswordForm'])->name('password.change');
Route::post('/settings/password', [SettingsController::class, 'changePassword']);

// Password Reset
Route::get('/settings/password/showReset', [SettingsController::class, 'showPasswordResetForm'])->name('password.reset');
Route::post('/Settings/password/reset', [SettingsController::class,'resetPassword']);

Route::middleware(['auth'])->group(function () {
    // Define your settings routes here
});
Route::get('/settings', 'App\Http\Controllers\SettingsController@index')->name('settings');

