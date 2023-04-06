<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\CommentController;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/issues/create', [IssueController::class, 'create'])->name('createIssue');

Route::post('/issues/create', [IssueController::class, 'store'])->name('storeIssue');

Route::get('/issues', [IssueController::class, 'all'])->name('allIssues');

Route::get('/issues/my', [IssueController::class, 'myissues'])->name('myissues');

Route::get('/issues/assigned', [IssueController::class, 'assignedissues'])->name('assignedIssues');

Route::get('/issues/{id}', [IssueController::class, 'show']);

Route::post('/issues/{id}/edit', [IssueController::class, 'edit']);

Route::get('/issues/{id}/close', [IssueController::class, 'close']);

Route::post('/issues/{id}/assign_to', [IssueController::class, 'assign']);

Route::post('/issues/{id}/newComment', [CommentController::class, 'store']);

Route::post('/comments/{id}/edit', [CommentController::class, 'edit']);

Route::get('/comments/{id}/delete', [CommentController::class, 'delete']);

Route::get('/teams', [TeamController::class, 'all'])->name('allTeams');

Route::get('/teams/create', [TeamController::class, 'create'])->name('createTeam');

Route::post('/teams/create', [TeamController::class, 'store'])->name('storeTeam');

Route::get('/teams/{id}', [TeamController::class, 'show']);

Route::get('/teams/{id}/delete', [TeamController::class, 'delete']);

Route::post('/teams/{id}/edit', [TeamController::class, 'edit']);

Route::post('/teams/changeTeam', [TeamController::class, 'changeTeam'])->name('changeTeam');

Route::get('/users', [UserController::class, 'all'])->name('allUsers');

Route::get('/users/create', [UserController::class, 'create'])->name('createUser');

Route::post('/users/create', [UserController::class, 'store'])->name('storeUser');

Route::post('/users/updateInfo', [UserController::class, 'updateInfo'])->name('updateUserInfo');

Route::post('/users/updatePassword', [UserController::class, 'updatePassword'])->name('updateUserPassword');

Route::get('/users/{id}/resetPassword', [UserController::class, 'resetPassword']);

Route::get('/profile', [UserController::class, 'profile'])->name('profile');
