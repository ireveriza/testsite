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
    return redirect()->route('people.list');
});

Route::get('/people', [\App\Http\Controllers\PersonController::class, 'index'])->name('people.list');
Route::post('/people', [\App\Http\Controllers\PersonController::class, 'store'])->name('people.store');
Route::get('/people/create', [\App\Http\Controllers\PersonController::class, 'create'])->name('people.create');
Route::get('/people/{person}/edit', [\App\Http\Controllers\PersonController::class, 'edit'])->name('people.edit');
Route::put('/people/{person}', [\App\Http\Controllers\PersonController::class, 'update'])->name('people.update');
Route::delete('/people/{person}', [\App\Http\Controllers\PersonController::class, 'destroy'])->name('people.destroy');

Route::get('/organizations', [\App\Http\Controllers\OrganizationController::class, 'index'])->name('organizations.list');
Route::post('/organizations', [\App\Http\Controllers\OrganizationController::class, 'store'])->name('organizations.store');
Route::get('/organizations/create', [\App\Http\Controllers\OrganizationController::class, 'create'])->name('organizations.create');
Route::get('/organizations/{organization}/edit', [\App\Http\Controllers\OrganizationController::class, 'edit'])->name('organizations.edit');
Route::put('/organizations/{organization}', [\App\Http\Controllers\OrganizationController::class, 'update'])->name('organizations.update');
Route::delete('/organizations/{organization}', [\App\Http\Controllers\OrganizationController::class, 'destroy'])->name('organizations.destroy');

