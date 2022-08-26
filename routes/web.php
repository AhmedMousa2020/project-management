<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\IssueController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserIssuesController;
use App\Http\Controllers\FileUploadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssueuserController;

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
Route::get('/dashboard', [DashboardController::class, 'index']);
require __DIR__.'/auth.php';

// for test store projects
Route::get('/test-projects/{id}', [ProjectController::class, 'show']);

//admin
Route::group(['middleware' => 'auth'], function(){
    Route::get('admin/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('users', UserController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('issues', IssueController::class);
    Route::delete('issueuser/delete/{issue_id}/{user_id}', [IssueuserController::class,'delete'])->name('issueuser.delete');
});

//user
Route::group(['middleware' => 'auth'], function(){
    Route::get('user/dashboard', [UserDashboardController::class, 'dashboard'])->name('user.dashboard');
    Route::resource('user-issues', UserIssuesController::class);
    Route::get('user-issues/{issue_id}/edit', [UserIssuesController::class, 'edit'])->name('user-issues.edit');
});

//upload File
Route::group(['middleware' => 'auth'], function(){
    Route::get('file-upload', [FileUploadController::class, 'index']);
    Route::put('upload', [FileUploadController::class, 'store'])->name('file.upload');
});