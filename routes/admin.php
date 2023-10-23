<?php

use App\Http\Controllers\admin\category\CategoryController;
use App\Http\Controllers\admin\course\CourseController;
use App\Http\Controllers\admin\level\LevelController;
use App\Http\Controllers\admin\price\PriceController;
use App\Http\Controllers\admin\resource\ResourceController;
use App\Http\Controllers\admin\role\RoleController;
use App\Http\Controllers\admin\user\UserController;
use Illuminate\Support\Facades\Route;




/**RUTA PARA LOS ROLES Y PERMISOS */
Route::get('/admin/role', [RoleController::class, 'index'])->name('admin.roles.index');
Route::get('/admin/role/create', [RoleController::class, 'create'])->name('admin.roles.create');
Route::post('/admin/role/store', [RoleController::class, 'store'])->name('admin.roles.store');
Route::put('/admin/role/update/{role}', [RoleController::class, 'update'])->name('admin.roles.update');
Route::get('/admin/role/edit/{role}', [RoleController::class, 'edit'])->name('admin.roles.edit');
Route::delete('/admin/role/destroy/{role}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');



Route::get('/admin/user', [UserController::class, 'index'])->name('admin.users.index');
Route::get('/admin/user/create', [UserController::class, 'create'])->name('admin.users.create');
Route::post('/admin/user/store', [UserController::class, 'store'])->name('admin.users.store');
Route::put('/admin/user/update/{user}', [UserController::class, 'update'])->name('admin.users.update');
Route::get('/admin/user/edit/{user}', [UserController::class, 'edit'])->name('admin.users.edit');



Route::get('/admin/course/index', [CourseController::class, 'index'])->name('admin.courses.index');
Route::get('/admin/course/show/{course:slug}', [CourseController::class, 'show'])->name('admin.courses.show');
Route::post('/admin/course/approved/{course:slug}', [CourseController::class, 'approved'])->name('admin.courses.approved');



Route::get('/admin/price/index', [PriceController::class , 'index'])->name('admin.prices.index');
Route::get('/admin/category/index', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::get('/admin/level/index',[LevelController::class, 'index'])->name('admin.levels.index');
Route::get('/admin/resource/index', [ResourceController::class , 'index'])->name('admin.resources.index');