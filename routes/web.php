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

Route::get('/admin/register', function () {
    return view('admin.register');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::middleware(['intern'])->group(function () {
        Route::get('/user/profile/info', [\App\Http\Controllers\InternController::class, 'show'])
            ->name('profile.info');
        Route::get('/user/profile/submissions', [\App\Http\Controllers\InternController::class, 'submissions'])
            ->name('submissions');
        Route::get('/user/profile/accepted', [\App\Http\Controllers\InternController::class, 'accepted'])
            ->name('acceptedSubmissions');
    });

    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/list', [\App\Http\Controllers\AdminController::class, 'ListEnterprises'])
            ->name('ListEnterprises');
    });

    Route::middleware(['enterprise'])->group(function () {
        Route::get('/dashboard', function () {
            dd(1);
            return view('dashboard');
        })->name('dashboard');

        Route::get('/enterprise/submissions', [\App\Http\Controllers\EnterpriseController::class, 'ListSubmissions'])
            ->name('ListSubmissions');

        Route::get('/enterprise/internships', [\App\Http\Controllers\EnterpriseController::class, 'ListInternships'])
            ->name('ListInternships');

    });
});

Route::get('/dashboard', function () {
    $userId = Illuminate\Support\Facades\Auth::user();
    if($userId != null &&  \App\Models\User::find($userId->getAuthIdentifier())->user_type == 'intern'){
            return view('intern.index');
    }
    if($userId != null &&  \App\Models\User::find($userId->getAuthIdentifier())->user_type == 'admin'){
            return view('admin.index');
    }
    if($userId != null &&  \App\Models\User::find($userId->getAuthIdentifier())->user_type == 'enterpriseRep'){
        return view('enterprise.index');
    }
    return view('auth.login');

})->name('dashboard');
