<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\McqController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DifficultieController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ResourceController;

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

Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

//    Grade Route Here
    Route::resource('grade',GradeController::class);
    Route::resource('mcq',McqController::class);
    Route::resource('language',LanguageController::class);
    Route::resource('difficulties',DifficultieController::class);
    Route::resource('course',CourseController::class);
    Route::get('create-unit/{id}',[CourseController::class,'createUnit'])->name('unit.create');
    Route::post('store-unit',[CourseController::class,'storeUnit'])->name('unit.store');
    Route::get('edit-unit/{id}',[CourseController::class,'editUnit'])->name('unit.edit');
    Route::put('update-unit/{id}',[CourseController::class,'updateUnit'])->name('unit.update');
    Route::delete('delete-unit/{id}',[CourseController::class,'deleteUnit'])->name('unit.destroy');
    Route::resource('resource',ResourceController::class);
});
