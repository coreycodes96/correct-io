<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function login(Request $data)
    {
        $data->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'min:8', 'max:255']
        ]);

        if (User::where('email', $data['email'])->count() === 0) {
            return response()->json(['errors' => ['email' => ['The email you have entered does not exist']]], 422);
        }

        //attempting to log the user in
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            //if the data matches
            return response()->json('successfully logged in', 200);
        } else {
            //if the data does not match
            return response()->json('Incorrect Data', 422);
        }
    }
}