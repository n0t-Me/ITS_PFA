<?php

use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/login');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/issues/create', [App\Http\Controllers\IssueController::class, 'create'])->name('createIssue');

Auth::routes();

Route::post('/issues/create', [App\Http\Controllers\IssueController::class, 'store'])->name('storeIssue');

Auth::routes();

Route::get('/issues', [App\Http\Controllers\IssueController::class, 'all'])->name('allIssues');

Auth::routes();

Route::get('/issues/my', [App\Http\Controllers\IssueController::class, 'myissues'])->name('myissues');

Auth::routes();

Route::get('/issues/{id}', [App\Http\Controllers\IssueController::class, 'show']);

Auth::routes();

Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
