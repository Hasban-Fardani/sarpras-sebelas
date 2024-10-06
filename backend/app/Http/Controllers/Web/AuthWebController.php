<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthWebController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required',
            'password' => 'required',
        ]);

        // if validation fails
        if ($validator->fails()) {
            #dd('yahahah gagal');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        // dd(Hash::make($validator->validated()['password']), User::where('nip', $validator->validated()['nip'])->first());
        if (!Auth::attempt($validator->validated()))
        {
            return redirect()->back()->with('errors', ['wrong username or password']);
        }

        return redirect()->route('telescope');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('web.login.page');
    }
}
