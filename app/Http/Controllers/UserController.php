<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $attributes = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (auth()->attempt($attributes)) {
            session()->regenerate();
            return redirect('/')->with('message', 'Log in successdully');
        }
        throw ValidationException::withMessages([
            'email' => 'something went wrong'
        ]);
        //  return $request->input();
    }

    public function destroy()
    {
        auth()->logout();
        return redirect('/')->with('message', 'Goodbye!');
    }
}
