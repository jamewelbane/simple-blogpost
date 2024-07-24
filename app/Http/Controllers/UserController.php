<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    // registration
    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:20', Rule::unique('users', 'name')],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'max:200']
        ]);

        $incomingFields['password'] = bcrypt($request->input('password'));
        $user = User::create($incomingFields);
        auth()->login($user);
        return redirect('/');
    }

    // logout
    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }

    // login
    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);

        if (auth()->attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();

            // Get the authenticated user
            $user = auth()->user();

            // Pass $user to the view
            return redirect('/')->with('success', 'You are successfully logged in!')->with('user', $user);
        } else {
            return redirect('/')->with('error', 'The password or name is incorrect');
        }
    }
}
