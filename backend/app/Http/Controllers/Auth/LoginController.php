<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

/**
 * @group Auth
 *
 * API endpoints for login
 */
class LoginController extends Controller
{
    /**
     * Login endpoint
     * 
     * @bodyParam id string required Example: 2121021210
     * @bodyParam password string required Example: password123
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
            ], 412);
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
