<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt(array_merge($credentials, ['type' => 'admin']))) {
            $user = Auth::guard('admin')->user();
            $user->update(['is_online' => true, 'last_seen_at' => now()]);
            
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function showRegister()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'admin',
        ]);

        Auth::guard('admin')->login($user);
        $user->update(['is_online' => true, 'last_seen_at' => now()]);

        return redirect()->route('admin.dashboard');
    }

    public function logout()
    {
        $user = Auth::guard('admin')->user();
        if ($user) {
            $user->update(['is_online' => false, 'last_seen_at' => now()]);
        }
        
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        $onlineUsers = User::where('is_online', true)->get();
        return view('admin.dashboard', compact('onlineUsers'));
    }
}