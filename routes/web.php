<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ReportsController;

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

Route::get('/', [ReportsController::class, 'index'])->name('main');

Route::middleware('guest')->group(function (){
    Route::get('/login', [AuthController::class, 'loginIndex'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'registerIndex'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('role:user,admin')->group(function (){
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/list/my', [ReportsController::class, 'myIndex'])->name('my');
    Route::get('/list/saved', [ReportsController::class, 'savedIndex'])->name('saved');

    Route::get('/add', [ReportsController::class, 'addIndex'])->name('add');
    Route::post('/add', [ReportsController::class, 'add']);

    Route::delete('/report/{report}', [ReportsController::class, 'deleteReport']);
    Route::post('/report/{report}', [ReportsController::class, 'comment']);

    Route::delete('{report}/comment/{comment}', [ReportsController::class, 'deleteComment'])->name('comment');
    Route::get('{report}/comment/{comment}', [ReportsController::class, 'commentIndex']);
    Route::post('{report}/comment/{comment}', [ReportsController::class, 'editComment']);

    Route::get('/report/{report}/edit', [ReportsController::class, 'editReportIndex'])->name('report.edit');
    Route::post('/report/{report}/edit', [ReportsController::class, 'editReport']);

    Route::post('/save/{report}', [ReportsController::class, 'saveReport'])->name('save');
    Route::delete('/save/{report}', [ReportsController::class, 'forgetReport']);

    Route::delete('/user/{user}', [UsersController::class, 'deleteUser'])->name('user');
    Route::get('/user/{user}', [UsersController::class, 'userIndex']);
    Route::post('/user/{user}', [UsersController::class, 'editUser']);

    Route::get('/me', [UsersController::class, 'meIndex'])->name('me');

    Route::get('/password', [UsersController::class, 'passwordIndex'])->name('password');
    Route::post('/password', [UsersController::class, 'changePassword']);
});

Route::middleware('role:admin')->group(function (){
    Route::get('/users/list', [UsersController::class, 'usersIndex'])->name('users');

    Route::delete('/statuses/{status}', [ReportsController::class, 'deleteStatus'])->name('status');
    Route::get('/statuses/{status}', [ReportsController::class, 'statusIndex']);
    Route::post('/statuses/{status}', [ReportsController::class, 'editStatus']);

    Route::get('/status/add', [ReportsController::class, 'addStatusIndex'])->name('status.add');
    Route::post('/status/add', [ReportsController::class, 'addStatus']);

    Route::get('/statuses', [ReportsController::class, 'statusesIndex'])->name('statuses');
});

Route::get('/list/{status}', [ReportsController::class, 'listIndex'])->name('list');

Route::get('/report/{report}', [ReportsController::class, 'reportIndex'])->name('report');
