<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\IncomingItemController;
use App\Http\Controllers\Admin\IncomingItemDetailController;
use App\Http\Controllers\Admin\OutgoingItemController;
use App\Http\Controllers\Admin\OutgoingItemDetailController;
use App\Http\Controllers\Admin\RequestItemController;
use App\Http\Controllers\Admin\RequestItemDetailController;
use App\Http\Controllers\Admin\SubmissionItemController;
use App\Http\Controllers\Admin\SubmissionItemDetailController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Supervisor\RequestCheckController;
use App\Http\Controllers\Supervisor\SubmissionCheckController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

Route::get('/', function () {
    return [
        "message" => "hello, please visit /docs for documentation",
        "docs" =>  URL::to('/docs')
    ];
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

    Route::post('/employee/{employee}/assign', [EmployeeController::class, 'assign']);
    Route::post('/employee/{employee}/unassign', [EmployeeController::class, 'unassign']);
    Route::apiResource('employees', EmployeeController::class);
    Route::apiResource('users', UsersController::class);

    Route::apiResource('category', CategoryController::class);

    Route::apiResource('item', ItemController::class);

    Route::apiResource('supplier', SupplierController::class);

    Route::apiResource('incoming-item', IncomingItemController::class)
        ->except('update');
    Route::apiResource('incoming-item.detail', IncomingItemDetailController::class)
        ->except('show');

    Route::apiResource('outgoing-item', OutgoingItemController::class)
        ->except('update');
    Route::apiResource('outgoing-item.detail', OutgoingItemDetailController::class)
        ->except('show');

    Route::post('/submission/{submission}/accept', [SubmissionCheckController::class, 'accept']);
    Route::post('/submission/{submission}/decline', [SubmissionCheckController::class, 'decline']);
    Route::apiResource('submission', SubmissionItemController::class)
        ->except('update');
    Route::apiResource('submission.detail', SubmissionItemDetailController::class)
        ->except('show');

    Route::post('/request/{request}/accept', [RequestCheckController::class, 'accept']);
    Route::post('/request/{request}/decline', [RequestCheckController::class, 'decline']);
    Route::apiResource('request-item', RequestItemController::class)
        ->except('update');
    Route::apiResource('request-item.detail', RequestItemDetailController::class)
        ->except('show')
        ->parameter('detail', 'requestItemDetail');
});
