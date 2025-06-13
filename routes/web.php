<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

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
