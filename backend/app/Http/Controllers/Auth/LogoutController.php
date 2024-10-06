<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @group 0. Authentication
 *
 * API endpoints for logout
 */
class LogoutController extends Controller
{
    public function __invoke(Request $request)
    {
        // delete current user token
        auth()->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'logged out'
        ]);
    }
}
