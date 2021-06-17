<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware(['intern'])->group(function () {
        Route::get('/intern', function () {
            //
        });
    });

    Route::middleware(['admin'])->group(function () {
        Route::get('/admin', function () {
            //
        });
    });

    Route::middleware(['enterprise'])->group(function () {
        Route::get('/enterprise', function () {
            //
        });
    });
});
