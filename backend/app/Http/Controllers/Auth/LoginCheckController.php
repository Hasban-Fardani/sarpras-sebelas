<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group 0. Authentication
 *
 * API for check if user loged in
 */
class LoginCheckController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();
        return response()->json([
            'user' => $user,
            'token' => $user->createToken($user->name)->plainTextToken
        ]);
    }
}
