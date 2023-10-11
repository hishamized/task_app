<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
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

Route::get('/dashboard', [DashboardController::class, 'show_dashboard'])->name('show_dashboard');


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

Route::post('/my-profile/update', [ProfileController::class, 'updateProfile'])->name('updateProfile');

Route::get('/admin-dashboard', [AdminController::class, 'showAdminDashboard'])
    ->name('showAdminDashboard');

Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');

Route::get('/admin-dashboard/{id}', [ProjectController::class, 'viewProject'])->name('project.view');

Route::post('/edit-project', [ProjectController::class, 'editProject'])->name('editProject');

Route::post('/add-people', [ProjectController::class, 'addPeople'])->name('addPeople');

Route::get('/remove-project-mate/{projectMate}', [ProjectController::class, 'removeProjectMate'])->name('removeProjectMate');





Route::get('/admin-dashboard', [AdminController::class, 'showAdminDashboard'])
    ->name('showAdminDashboard');

Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');

Route::get('/admin-dashboard/{id}', [ProjectController::class, 'viewProject'])->name('project.view');

Route::post('/edit-project', [ProjectController::class, 'editProject'])->name('editProject');

Route::post('/add-people', [ProjectController::class, 'addPeople'])->name('addPeople');

Route::get('/remove-project-mate/{projectMate}', [ProjectController::class, 'removeProjectMate'])->name('removeProjectMate');





Route::get('/dashboard', [DashboardController::class, 'show_dashboard'])->name('show_dashboard');


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
Route::get('/settings', 'App\Http\Controllers\SettingsController@index')->name('settings');Route::get('/admin-dashboard', [AdminController::class, 'showAdminDashboard'])
    ->name('showAdminDashboard');

Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');

Route::get('/admin-dashboard/{id}', [ProjectController::class, 'viewProject'])->name('project.view');

Route::post('/edit-project', [ProjectController::class, 'editProject'])->name('editProject');

Route::post('/add-people', [ProjectController::class, 'addPeople'])->name('addPeople');

Route::get('/remove-project-mate/{projectMate}', [ProjectController::class, 'removeProjectMate'])->name('removeProjectMate');





Route::get('/dashboard', [DashboardController::class, 'show_dashboard'])->name('show_dashboard');


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

Route::post('/create-task', [TaskController::class, 'createTask'])->name('createTask');

Route::get('/tasksAdmin/{taskId}', [TaskController::class, 'showTaskAdmin'])->name('showTaskAdmin');

Route::post('/editTask', [TaskController::class, 'editTask'])->name('editTask');

Route::post('/assignTask', [TaskController::class, 'assignTask'])->name('assignTask');

Route::delete('/removeUserFromTask/{userId}/{taskId}', [TaskController::class, 'removeUserFromTask'])->name('removeUserFromTask');

