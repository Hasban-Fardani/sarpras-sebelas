<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Supervisor;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncomingItemController;
use App\Http\Controllers\IncomingItemDetailController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OutgoingItemController;
use App\Http\Controllers\OutgoingItemDetailController;
use App\Http\Controllers\RequestItemController;
use App\Http\Controllers\RequestItemDetailController;
use App\Http\Controllers\SubmissionItemController;
use App\Http\Controllers\SubmissionItemDetailController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "Hi, please visit <a href='" . env('APP_URL') . "/docs'>" . env('APP_URL') . "/docs </a> for documentation";
});

Route::get('/public/{path}', FileController::class)->where('path', '.*');

Route::prefix('/auth')->group(function () {
    Route::post('/login', LoginController::class);
    Route::middleware('auth:sanctum')->post('/logout', LogoutController::class);
    Route::get('/user', function () {
        return Auth::user();
    })->middleware('auth:sanctum');
    Route::get('/check', function () {
        return Auth::check();
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/private/{path}', FileController::class)->where('path', '.*');

    Route::prefix('/dashboard')->group(function () {
        Route::get('/counts', [DashboardController::class, 'getCounts']);
        Route::get('/stats/request', [DashboardController::class, 'getStatsRequest']);
        Route::get('/stats/item', [DashboardController::class, 'getStatsItem']);
    });

    // Item Management
    Route::apiResource('category', CategoryController::class);

    Route::apiResource('item', ItemController::class);


    // Transactions
    Route::apiResource('incoming-item', IncomingItemController::class)
        ->except('update');
    Route::apiResource('incoming-item.detail', IncomingItemDetailController::class)
        ->except('show');

    Route::apiResource('outgoing-item', OutgoingItemController::class)
        ->except('update');
    Route::apiResource('outgoing-item.detail', OutgoingItemDetailController::class)
        ->except('show');

    Route::apiResource('submission', SubmissionItemController::class)
        ->except('update');
    Route::apiResource('submission.detail', SubmissionItemDetailController::class)
        ->except('show');

    Route::apiResource('request-item', RequestItemController::class)
        ->except('update');
    Route::apiResource('request-item.detail', RequestItemDetailController::class)
        ->except('show')
        ->parameter('detail', 'requestItemDetail');

    Route::prefix('admin')->middleware('can:admin')->group(function () {
        Route::apiResource('supplier', Admin\SupplierController::class);
        // Users and Employees
        Route::post('/employee/{employee}/assign', [Admin\EmployeeController::class, 'assign']);
        Route::post('/employee/{employee}/unassign', [Admin\EmployeeController::class, 'unassign']);
        Route::apiResource('employees', Admin\EmployeeController::class);
        Route::apiResource('users', Admin\UsersController::class);
    });

    Route::middleware('can:supervisor')->group(function () {
        Route::post('/submission/{submission}/accept', [Supervisor\SubmissionCheckController::class, 'accept']);
        Route::post('/submission/{submission}/decline', [Supervisor\SubmissionCheckController::class, 'decline']);
        Route::post('/request/{request}/accept', [Supervisor\RequestCheckController::class, 'accept']);
        Route::post('/request/{request}/decline', [Supervisor\RequestCheckController::class, 'decline']);
    });
});
