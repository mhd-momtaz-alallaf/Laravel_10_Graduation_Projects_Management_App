<?php

use Illuminate\Support\Facades\Route;
//this is a local middleware.
Route::middleware(['role:admin','auth'])->group(function (){ // or we can perform the middlewares from the RouteServiceProvider (Global middleware)

    Route::get('/permissions',[App\Http\Controllers\PermissionController::class, 'index'])->name('permissions.index');
    Route::post('/permissions',[App\Http\Controllers\PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/permissions/{permission}/edit',[App\Http\Controllers\PermissionController::class, 'edit'])->name('permission.edit');
    Route::delete('/permissions/{permission}/delete',[App\Http\Controllers\PermissionController::class, 'destroy'])->name('permission.destroy');
    Route::put('/permissions/{permission}/update',[App\Http\Controllers\PermissionController::class, 'update'])->name('permission.update');

});
