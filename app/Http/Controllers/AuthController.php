<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{   
    public function index()
    {
        // Sabhi registered users ko fetch karega
        $users = User::orderBy('id', 'desc')->paginate(10);

        return view('admin.users.index', compact('users'));
    }
    // Show register form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'employee' // default employee
        ]);
         Auth::login($user);

        $user->sendEmailVerificationNotification();

        return redirect()->route('verification.notice');
    }

    // Show login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    // Sirf active user login kar paaye
    if (Auth::attempt(array_merge($credentials, ['status' => 'active']))) {
        return redirect()->route('dashboard');
    }

    // Check karo ki user hai ya nahi
    $user = \App\Models\User::where('email', $request->email)->first();

    if ($user && $user->status !== 'active') {
        return back()->withErrors(['email' => 'Your account is ' . $user->status . '. Please contact admin.']);
    }

    return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
}

     
    public function updateStatus(Request $request, $id)
{
    $user = User::findOrFail($id);

    if ($user->role === 'admin') {
        return back()->withErrors(['error' => 'You cannot change admin status.']);
    }

    $user->status = $request->status;
    $user->save();

    return back()->with('success', 'User status updated successfully.');
}

    public function show($id)
{
    $user = User::findOrFail($id);
    return view('admin.users.show', compact('user'));
}

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
