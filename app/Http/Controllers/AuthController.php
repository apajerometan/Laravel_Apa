<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show registration page
    public function showRegister()
    {
        return view('pages.register');
    }

    // Process registration
    public function register(Request $request)
    {
        // Check if email already exists
        $existingUser = User::where('email', $request->email)->first();
        
        if ($existingUser) {
            return redirect()->back()->with('error', 'Email already exists!');
        }

        // Check if password and confirm password match
        if ($request->password != $request->confirmpassword) {
            return redirect()->back()->with('error', 'Password does not match');
        }

        // Create user
        $user = new User();
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        // Success
        return redirect()->route('login')->with('success', 'Registration Successful! Please login.');
    }

    // Show login page
    public function showLogin()
    {
        return view('pages.login');
    }

    // Process login
    public function login(Request $request)
    {
        // Check if user exists
        $user = User::where('email', $request->email)->first();
        
        // Check if user is empty OR password is incorrect
        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Invalid email or password!');
        }
        
        // Create session and save user
        session([
            'user' => $user->fullname,
            'email' => $user->email,
            'id' => $user->id
        ]);
        
        // Redirect to dashboard with success message
        return redirect()->route('dashboard')->with('success', 'Welcome back, ' . $user->fullname . '!');
    }

    // Dashboard
    public function dashboard()
    {
        if (!session('user')) {
            return redirect()->route('login');
        }

            $user = session('user');
            $totalUsers = User::count();
            $totalCustomers = \App\Models\Customer::count();
            $myCustomers = \App\Models\Customer::where('user_id', session('id'))->count();
    
    return view('pages.dashboard', compact('user', 'totalUsers', 'totalCustomers', 'myCustomers'));
    }

    // Logout
    public function logout()
    {
        session()->forget('user');
        session()->forget('email');
        session()->forget('id');
    
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }

    // Display users table
    public function users()
    {
        if (!session('user')) {
            return redirect()->route('login');
        }

        $users = User::all();
        return view('pages.users', compact('users'));
    }

    // Add user
    public function addUser(Request $request)
    {
    // Check if email exists
    $existing = User::where('email', $request->email)->first();
    
    if ($existing) {
        return redirect()->back()->with('error', 'Email already exists!');
    }
    
    // Check password match
    if ($request->password != $request->confirmpassword) {
        return redirect()->back()->with('error', 'Password does not match!');
    }
    
    // Create user
    $user = new User();
    $user->fullname = $request->fullname;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->save();
    
    return redirect()->back()->with('success', 'User added successfully!');
    }

    // Update user
    public function updateUser(Request $request)
    {
    $user = User::find($request->user_id);
    
    // Check if email exists (exclude current user)
    $existing = User::where('email', $request->email)
                    ->where('id', '!=', $request->user_id)
                    ->first();
    
    if ($existing) {
        return redirect()->back()->with('error', 'Email already used by another user!');
    }
    
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->save();
    
    return redirect()->back()->with('success', 'User updated successfully!');
    }

    // Delete user
    public function deleteUser(Request $request)
    {
        $user = User::find($request->user_id);
        $user->delete();
    
    return redirect()->back()->with('success', 'User deleted successfully!');
    }

    // Show profile page
public function profile()
{
    if (!session('user')) {
        return redirect()->route('login');
    }
    
    $user = User::find(session('id'));
    return view('pages.profile', compact('user'));
}

// Update profile
public function updateProfile(Request $request)
{
    $user = User::find(session('id'));
    
    // Handle profile picture upload ONLY
    if ($request->hasFile('profile_pic')) {
        $file = $request->file('profile_pic');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $filename);
        $user->profile_pic = $filename;
        $user->save();
        
        return redirect()->back()->with('success', 'Profile picture uploaded!');
    }
    
    // Update user info (only if form submitted with fullname)
    if ($request->has('fullname')) {
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->gender = $request->gender;
        
        // Update password if provided
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->with('error', 'Current password is incorrect!');
            }
            
            if ($request->new_password != $request->confirm_password) {
                return redirect()->back()->with('error', 'New passwords do not match!');
            }
            
            $user->password = Hash::make($request->new_password);
        }
        
        $user->save();
        
        // Update session
        session(['user' => $user->fullname, 'email' => $user->email]);
        
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
    
    return redirect()->back();
}

}

