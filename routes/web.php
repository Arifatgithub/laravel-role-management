<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\{
    User,
    Permission,
    Role
};
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
    return View('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('user-profile', function () {
        return view('welcome');
    });

    Route::group([
        'middleware' => 'checkRoute',
        'type' => 'admin-profile'
    ], function () {
        Route::get('admin-profile', function () {
            return view('dashboard');
        });
    });
});
// login route
Route::get("/admin/login",[AdminController::class, 'login']);
// admin group route
Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('admin/dashboard', [AdminController::class, 'index']);
    Route::get('admin/logout', [AdminController::class, 'logout']);
    Route::get('admin/profile', [AdminController::class, 'profile']);
});
Route::middleware(['auth','role:agent'])->group(function(){
    Route::get('agent/dashboard', [AgentController::class, 'index']);
});
