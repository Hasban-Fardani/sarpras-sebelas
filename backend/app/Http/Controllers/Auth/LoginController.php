<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

/**
 * @group 0. Authentication
 * @unauthenticated
 * 
 * API endpoints for login
 */
class LoginController extends Controller
{
    /**
     * Login endpoint
     * 
     * @queryParam by string. nip, username, email. default nip. Example: nip
     * @bodyParam nip required string. Example: 197806311574231883
     * @bodyParam password required string. Example: _y0urStrongPW#
     * 
     * @response 200 scenario="success" {
     *   "message": "login success",
     *   "token": "100|7MqxJ938cIzHmyZpPxzWNH6SF9qc2DIShTzaZFD1e34787w",
     *   "user": "admin"
     * }
     * 
     * @response 401 scenario="incorrect credentials" {
     *    "message": "wrong username or password",
     * }
     */
    public function __invoke(Request $request)
    {
        // get login type by 'id' or 'username' or 'email'
        $type = $request->input('by', 'nip');
        if ($type != 'nip' && $type != 'username' && $type != 'email') {
            return response()->json([
                'message' => 'invalid login type'
            ], 400);
        }

        // validate request
        $validator = Validator::make($request->all(), [
            $type => 'required',
            'password' => 'required|min:5'
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => 'invalid fields',
                'errors' => $validator->errors()
            ], 422);
        }

        // login user
        $data = [
            $type => $request->input($type),
            'password' => $request->input('password'),
        ];
        $login = Auth::attempt($data);

        // check if login failed
        if (!$login) {
            return response()->json([
                'message' => 'wrong username or password'
            ], 401);
        }

        // create token
        $user = Auth::user();
        $token = $user->createToken('accessToken')->plainTextToken;

        Log::info("logged in user: {$user}");

        // return token and user info
        return response()->json([
            'message' => 'login success',
            'token' => $token,
            'user' => $user
        ]);
    }
}
