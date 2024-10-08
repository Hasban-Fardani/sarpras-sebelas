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
    /**
     * @response 200 {
     *   "token": "100|7MqxJ938cIzHmyZpPxzWNH6SF9qc2DIShTzaZFD1e34787w",
     *   "user": {
     *     "username": "admin",
     *     "nip": "197832411574231883",
     *     "role": "admin"
     *   }
     * }
     */
    public function __invoke()
    {
        $user = Auth::user();
        $user['name'] = $user->name;
        return response()->json([
            'user' => $user,
            'token' => $user->createToken('accessToken')->plainTextToken
        ]);
    }
}
