<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/project/{project}', [App\Http\Controllers\ProjectController::class, 'show'])->name('project');

Route::middleware('auth')->group(function (){
    Route::get('/admin', [App\Http\Controllers\AdminsController::class, 'index'])->name('admin.index');

    Route::get('/admin/projects', [App\Http\Controllers\ProjectController::class, 'index'])->name('project.index');
    Route::get('/admin/projects/create', [App\Http\Controllers\ProjectController::class, 'create'])->name('project.create');
    Route::post('/admin/projects', [App\Http\Controllers\ProjectController::class, 'store'])->name('project.store');

    Route::patch('/admin/projects/{project}/update', [App\Http\Controllers\ProjectController::class, 'update'])->name('project.update');
    Route::get('/admin/projects/{project}/edit', [App\Http\Controllers\ProjectController::class, 'edit'])->name('project.edit');
    Route::Delete('/admin/projects/{project}/destroy', [App\Http\Controllers\ProjectController::class, 'destroy'])->name('project.destroy');
    Route::put('/admin/projects/{project}/select',[App\Http\Controllers\ProjectController::class, 'select'])->name('project.select');


    Route::get('admin/users/{user}/profile',[App\Http\Controllers\UserController::class, 'show'])->name('user.profile.show');
    Route::put('admin/users/{user}/profile/update',[App\Http\Controllers\UserController::class, 'update'])->name('user.profile.update');
    Route::delete('admin/users/{user}/destroy',[App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');

});

//Route::get('/admin/projects/{project}/edit', [App\Http\Controllers\ProjectController::class, 'edit'])->middleware('can:view,project')->name('project.edit'); //to prevent any one not authorized to edit another user project and edit just his projects

Route::middleware(['role:admin','auth'])->group(function (){
    Route::get('admin/users',[App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::put('admin/users/{user}/attach',[App\Http\Controllers\UserController::class, 'attach'])->name('user.role.attach');
    Route::put('admin/users/{user}/detach',[App\Http\Controllers\UserController::class, 'detach'])->name('user.role.detach');
});
