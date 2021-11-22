<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;




//LOGIN
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/checklogin', [LoginController::class, 'checklogin'])->name('checklogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


//DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//USUARIOS
Route::get('/list-users', [UserController::class, 'index'])->name('index');
Route::get('user-edit/{id}', [UserController::class, 'edit'])->name('edit');
Route::get('user-delete/{id}', [UserController::class, 'delete'])->name('delete');
Route::get('user-add', function () { return view('user-add'); });
Route::post('user-add-confirm', [UserController::class, 'confirmUser'])->name('confirmUser');
Route::get('user-add-confirm', [UserController::class, 'confirmUser'])->name('confirmUser');
Route::post('user-alter', [UserController::class, 'alter'])->name('alter');

//PRODUTOS
Route::get('list-products', [ProductController::class, 'index'])->name('index');
Route::get('products-add', function () { return view('products.products-add'); });
Route::post('products-add-confirm', [ProductController::class, 'confirmProduct'])->name('confirmProduct');
Route::get('products-add-confirm', [ProductController::class, 'confirmProduct'])->name('confirmProduct');

Route::get('products-add-confirm', [ProductController::class, 'confirmProduct'])->name('confirmProduct');
Route::get('products-edit/{id}', [ProductController::class, 'edit'])->name('edit.products');
Route::get('products-delete/{id}', [ProductController::class, 'delete'])->name('delete.products');
Route::post('products-alter', [ProductController::class, 'alter'])->name('alter.products');
Route::get('/exibeFotoStore', [ProductController::class, 'exibeFotoStore'])->name('exibeFotoStore');
Route::get('/exibeFotoStore/{id}', [ProductController::class, 'exibeFotoStore'])->name('exibeFotoStore');

//RELATORIO
Route::get('/report', [ReportController::class, 'index'])->name('report');
