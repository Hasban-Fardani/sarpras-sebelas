<?php

use App\Http\Controllers\Web\AuthWebController;
use Illuminate\Support\Facades\Route;

Route::get('/web-logeen', function () {
    return view('login');
})->name('web.login.page');

Route::post('/do-web-login', [AuthWebController::class, 'login'])->name('web.login');
Route::delete('/web-logout', [AuthWebController::class, 'logout'])->name('web.logout');
