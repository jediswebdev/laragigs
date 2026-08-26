<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('users.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        // Hash password
        $formFields['password'] = bcrypt($formFields['password']);

        //Create user
        $user = User::create($formFields);

        //Login user
        Auth::login($user);

        return redirect('/')->with('message', 'User created and logged in');
    }

    /**
     * Display the specified resource.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'User has been logged out successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function login()
    {
        return view('users.login');
    }
    /**
     * Update the specified resource in storage.
     */
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($formFields)) { // Automatically logs user in if found in the users table
            $request->session()->regenerate();

            return redirect('/')->with('message', 'Welcome back ' . Auth::user()->name);
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
