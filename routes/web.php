<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BranchController;

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

// Ruta principal que gestiona tanto login como home
Route::get('/', function () {
    return auth()->check() ? view('pages.home') : view('pages.auth.login');
})->name('home');


Auth::routes();


Route::view(('/auth/register'), 'pages.auth.register')->name('auth.register');
Route::view(('/auth/password/reset'), 'pages.auth.passwords.reset')->name('auth.password.reset');
Route::view(('/auth/password/email'), 'pages.auth.passwords.email')->name('auth.password.email');
Route::view(('/auth/password/confirm'), 'pages.auth.passwords.confirm')->name('auth.password.confirm');

Route::view('/users', 'pages.users')->name('users');
Route::view('/categories', 'pages.categories')->name('categories');
Route::view('/products', 'pages.products')->name('products');
Route::view('/clients', 'pages.clients')->name('clients');
Route::view('/sales', 'pages.sales')->name('sales');
Route::view('/report-sales', 'pages.report-sales')->name('report-sales');

Route::get('/branches', [BranchController::class, 'index'])->name('branch.index');
Route::post('branch', [BranchController::class, 'store'])->name('branch.store');
Route::get('branch/{branch}/edit', [BranchController::class, 'edit'])->name('branch.edit');
Route::put('branch/{branch}', [BranchController::class, 'update'])->name('branch.update');
Route::delete('branch/{branch}', [BranchController::class, 'destroy'])->name('branch.destroy');
