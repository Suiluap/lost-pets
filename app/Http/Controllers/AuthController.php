<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginIndex()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!auth()->attempt($request->only('email', 'password'))) {
            return back()->with('status', 'Neteisingi prisijungimo duomenys.');
        }

        return redirect()->route('main');
    }

    public function registerIndex()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'phone' => 'required|regex:/^\+370[0-9]{8}$/|max:255',
            'town' => 'required|max:255',
            'password' => 'required|between:6,255',
            'password_confirmation' => 'required|same:password'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'town' => $request->town,
            'password' => Hash::make($request->password)
        ]);

        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('main');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        return redirect()->route('main');
    }
}
