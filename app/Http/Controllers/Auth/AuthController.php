<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show Register page
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle Registration (SRS: Unique USERID, Name, Phone, Email, Address mandatory)
    public function register(Request $request)
    {
        $request->validate([
            'user_id'  => 'required|string|max:30|unique:users,user_id',
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'required|digits_between:10,15',
            'address'  => 'required|string|max:500',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'user_id.unique'  => 'This User ID is already taken. Please choose a different one.',
            'email.unique'    => 'This email address is already registered.',
            'phone.digits_between' => 'Phone number must be 10 to 15 digits.',
        ]);

        $user = User::create([
            'user_id'  => $request->user_id,
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'address'  => $request->address,
            'role'     => 'user',
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Account created! Welcome to SOUND Entertainment.');
    }

    // Show Login page
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle Login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect('/')->with('success', 'Welcome back, ' . Auth::user()->name . '!');
        }

        return back()->withErrors([
            'email' => 'The email or password is incorrect.',
        ])->withInput($request->only('email'));
    }

    // Handle Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'You have been logged out.');
    }

    // Show profile page
    public function profile()
    {
        $user    = Auth::user();
        $reviews = \App\Models\Review::where('user_id', $user->id)->with('user')->orderBy('created_at', 'desc')->get();
        return view('auth.profile', compact('user', 'reviews'));
    }
}
