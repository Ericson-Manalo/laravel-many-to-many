<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Guests\HomeController as GuestHomeController;
use App\Http\Controllers\Admin\ProjectController;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [ AdminHomeController::class , 'home'])->name('home');
    Route::get('/projects/deleted', [ProjectController::class, 'deleted'])->name('projects.deleted');
    Route::post('/projects/deleted/{post}', [ProjectController::class, 'restore'])->name('projects.restore');
    Route::delete('/projects/deleted/{post}', [ProjectController::class, 'erased'])->name('projects.erased');
    Route::resource('/projects', ProjectController::class);

});


Route::name('guests.')->group(function () {
    Route::get('/', [ GuestHomeController::class , 'home'])->name('home');

});
