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
        Route::get('/user/profile/info', [\App\Http\Controllers\InternController::class, 'show'])
            ->name('profile.info');

        Route::get('/user/profile/submissions', [\App\Http\Controllers\InternController::class, 'submissions'])
            ->name('submissions');

        Route::get('/user/profile/accepted', [\App\Http\Controllers\InternController::class, 'accepted'])
            ->name('accepted');


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
