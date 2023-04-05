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

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/issues/create', [App\Http\Controllers\IssueController::class, 'create'])->name('createIssue');

Route::post('/issues/create', [App\Http\Controllers\IssueController::class, 'store'])->name('storeIssue');

Route::get('/issues', [App\Http\Controllers\IssueController::class, 'all'])->name('allIssues');

Route::get('/issues/my', [App\Http\Controllers\IssueController::class, 'myissues'])->name('myissues');

Route::get('/issues/{id}', [App\Http\Controllers\IssueController::class, 'show']);

Route::post('/issues/{id}/newComment', [App\Http\Controllers\CommentController::class, 'store']);

Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
