<?php

use App\Http\Controllers\AccreqController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\UserManageController;
use Illuminate\Support\Facades\Route;

// LOGIN AND REGISTER ROUTES 
Route::get('/', [AuthController::class, 'login'])->name('view_login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('/register', [AuthController::class, 'registerView'])->name('view_regist');
Route::post('/register/auth', [AuthController::class, 'register'])->name('auth.register');

// DASHBOARD ROUTES 
Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('role:Admin,User');

// RESIDENT ROUTES
Route::get('/resident', [ResidentController::class, 'index'])->name('resident.index')->middleware('role:Admin');
Route::get('/resident/create', [ResidentController::class, 'create'])->name('resident.create')->middleware('role:Admin');
Route::post('/resident', [ResidentController::class, 'store'])->name('resident.store')->middleware('role:Admin');
Route::get('/resident/{id}/edit', [ResidentController::class, 'edit'])->name('resident.edit')->middleware('role:Admin');
Route::put('/resident/{id}/update', [ResidentController::class, 'update'])->name('resident.update')->middleware('role:Admin');
Route::delete('/resident/{id}', [ResidentController::class, 'destroy'])->name('resident.delete')->middleware('role:Admin');

// ACCOUNT REQUEST ROUTES
Route::get('/accreq', [AccreqController::class, 'index'])->name('accreq.index')->middleware('role:Admin');
Route::post('/accreq/{id}/approve', [AccreqController::class, 'approve'])->name('accreq.approve')->middleware('role:Admin');
Route::post('/accreq/{id}/reject', [AccreqController::class, 'reject'])->name('accreq.reject')->middleware('role:Admin');

// USERS MANAGE ROUTES
Route::get('/usersManage', [UserManageController::class, 'index'])->name('userManage.index')->middleware('role:Admin');
Route::post('/userManage/{id}/approve', [UserManageController::class, 'approve'])->name('userManage.approve')->middleware('role:Admin');
Route::post('/userManage/{id}/reject', [UserManageController::class, 'reject'])->name('userManage.reject')->middleware('role:Admin');
Route::delete('/usersManage/{id}/delete', [UserManageController::class, 'destroy'])->name('userManage.delete')->middleware('role:Admin');
