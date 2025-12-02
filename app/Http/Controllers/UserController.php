<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    // Show Register Page
    public function index()
    {
        return view('register');
    }

    // Show Login Page
    public function login()
    {
        return view('login');
    }

    // Handle Login
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json([
                'message' => 'Login successful',
            ]);
        }

        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }

    // Dashboard
    public function dashboard()
    {
        $user = auth()->user();
        // dd($user); 
        return view('dashboard', compact('user'));
    }


    // staff count on dashboard
    public function staffCount()
    {
        $data = DB::table('users')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as staff_count')
            ->groupBy('date')
            ->get();

        return response()->json($data);
    }


    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
