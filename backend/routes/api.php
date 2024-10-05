<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Supervisor;
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

    Route::prefix('admin')->middleware('can:admin')->group(function () {
        
        Route::prefix('/dashboard')->group(function () {
            Route::get('/counts', [Admin\DashboardController::class, 'getCounts']);
            Route::get('/stats/request', [Admin\DashboardController::class, 'getStatsRequest']);
            Route::get('/stats/item', [Admin\DashboardController::class, 'getStatsItem']);
        });
    
        // Users and Employees
        Route::post('/employee/{employee}/assign', [Admin\EmployeeController::class, 'assign']);
        Route::post('/employee/{employee}/unassign', [Admin\EmployeeController::class, 'unassign']);
        Route::apiResource('employees', Admin\EmployeeController::class);
        Route::apiResource('users', Admin\UsersController::class);
    
        // Item Management
        Route::apiResource('category', Admin\CategoryController::class);
    
        Route::apiResource('item', Admin\ItemController::class);
    
        Route::apiResource('supplier', Admin\SupplierController::class);
    
        // Transactions
        Route::apiResource('incoming-item', Admin\IncomingItemController::class)
            ->except('update');
        Route::apiResource('incoming-item.detail', Admin\IncomingItemDetailController::class)
            ->except('show');
    
        Route::apiResource('outgoing-item', Admin\OutgoingItemController::class)
            ->except('update');
        Route::apiResource('outgoing-item.detail', Admin\OutgoingItemDetailController::class)
            ->except('show');
    
        Route::apiResource('submission', Admin\SubmissionItemController::class)
            ->except('update');
        Route::apiResource('submission.detail', Admin\SubmissionItemDetailController::class)
            ->except('show');
    
        Route::apiResource('request-item', Admin\RequestItemController::class)
            ->except('update');
        Route::apiResource('request-item.detail', Admin\RequestItemDetailController::class)
            ->except('show')
            ->parameter('detail', 'requestItemDetail');
    });

    Route::prefix('/supervisor')->middleware('can:supervisor')->group(function () {
        Route::post('/submission/{submission}/accept', [Supervisor\SubmissionCheckController::class, 'accept']);
        Route::post('/submission/{submission}/decline', [Supervisor\SubmissionCheckController::class, 'decline']);
        Route::post('/request/{request}/accept', [Supervisor\RequestCheckController::class, 'accept']);
        Route::post('/request/{request}/decline', [Supervisor\RequestCheckController::class, 'decline']);
    });
});
