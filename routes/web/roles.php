<?php

use Illuminate\Support\Facades\Route;

Route::get('/roles',[App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
Route::post('/roles',[App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
Route::delete('/roles/{role}/destroy',[App\Http\Controllers\RoleController::class, 'destroy'])->name('role.destroy');
Route::put('/roles/{role}/update',[App\Http\Controllers\RoleController::class, 'update'])->name('role.update');
Route::get('/roles/{role}/edit',[App\Http\Controllers\RoleController::class, 'edit'])->name('role.edit');
Route::put('/roles/{role}/attach',[App\Http\Controllers\RoleController::class, 'attach_permission'])->name('role.permissions.attach');
Route::put('/roles/{role}/detach',[App\Http\Controllers\RoleController::class, 'detach_permission'])->name('role.permissions.detach');

