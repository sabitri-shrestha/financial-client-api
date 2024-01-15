<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            // Return an Inertia response with validation errors
            return Inertia::render('Auth/Login', ['errors' => $validator->errors()->toArray()])
                ->with('errorBag', 'login');
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            // Return an Inertia response with custom error message
            return Inertia::render('Auth/Login', ['errors' => ['Invalid credentials']])
                ->with('errorBag', 'login');
        }

        return Redirect::route('financial-app.index');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    public function showLoginForm()
    {
        return Inertia::render('Auth/Login');
    }


}
