<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return redirect('/login');
});




Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    Route::get('/admin/users', [AdminController::class, 'users']);
    Route::post('/admin/users', [AdminController::class, 'storeUser']);
    Route::delete('/admin/user/{user}', [AdminController::class, 'destroyUser']);

    Route::get('/admin/demandes', [AdminController::class, 'demandes']);
    Route::post('/admin/demande/{demande}/status', [AdminController::class, 'updateStatus']);
});

Route::middleware(['employe'])->group(function () {
    Route::get('/employee/dashboard', [EmployeeController::class, 'dashboard']);
    Route::get('/employee/demande-form', [EmployeeController::class, 'showDemandeForm']);
    Route::post('/employee/demande', [EmployeeController::class, 'storeDemande']);
});