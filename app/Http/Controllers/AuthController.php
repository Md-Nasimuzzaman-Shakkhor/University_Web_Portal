<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    // 1. Show the Login Page
    public function showLogin() {
        return view('login');
    }
    public function showRegister() {
    return view('auth.register');
    }

    public function register(Request $request) {
    // 1. Validate the input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:4', // 'confirmed' looks for password_confirmation field
    ]);

    // 2. Create the Student
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password), // Securely hash the password!
        'role' => 'student', // Always set to student by default
    ]);

    // 3. Automatically Log them in
    Auth::login($user);

    // 4. Redirect to student dashboard
    return redirect('/student/dashboard');
    
    }
    // 2. Handle the Login Button Click
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
        
        // Check if the email and password match the database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // --- THE ROLE REDIRECT ---
            $user = Auth::user(); // Get the logged-in user details

            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            } else {
                return redirect('/student/dashboard');
            }
        }

        // If login fails
        return back()->withErrors(['email' => 'Invalid Credentials']);
    }

    // 3. Logout
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }
    
}
