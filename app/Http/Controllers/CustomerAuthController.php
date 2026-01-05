<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;

class CustomerAuthController extends Controller
{
    public function showLogin()
    {
        return view('customer.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('customer')->attempt(array_merge($credentials, ['type' => 'customer']))) {
            $user = Auth::guard('customer')->user();
            $user->update(['is_online' => true, 'last_seen_at' => now()]);
            
            return redirect()->route('customer.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function showRegister()
    {
        return view('customer.register');
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
            'type' => 'customer',
        ]);

        Auth::guard('customer')->login($user);
        $user->update(['is_online' => true, 'last_seen_at' => now()]);

        return redirect()->route('customer.dashboard');
    }

    public function logout()
    {
        $user = Auth::guard('customer')->user();
        if ($user) {
            $user->update(['is_online' => false, 'last_seen_at' => now()]);
        }
        
        Auth::guard('customer')->logout();
        return redirect()->route('customer.login');
    }

    public function dashboard(Request $request)
    {
        $query = Product::query();
        
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }
        
        $products = $query->paginate(12);
        return view('customer.dashboard', compact('products'));
    }

    public function showProduct(Product $product)
    {
        return view('customer.product-show', compact('product'));
    }
}