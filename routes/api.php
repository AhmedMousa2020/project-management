<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\IssueController;
use App\Http\Controllers\Api\UserIssuesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['api']], function() {
     Route::post('get-projects', [ProjectController::class, 'index']);
     Route::post('get-issues', [IssueController::class, 'index']);
     Route::post('get-user-issues', [UserIssuesController::class, 'index']);
});
