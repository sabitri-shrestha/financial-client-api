<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class RegisterController extends Controller
{
    public function register(Request $request)
    {

        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'confirmPassword'=>'same:password'
        ]);

        if ($validator->fails()) {
            return Inertia::render('Auth/Register', ['errors' => $validator->errors()->toArray()])
                ->with('errorBag', 'register');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return Redirect::route('login');
    }
    public function showRegisterForm()
    {
        return Inertia::render('Auth/Register');
    }

}
