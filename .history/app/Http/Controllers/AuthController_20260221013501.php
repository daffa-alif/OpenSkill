<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Return the login view
    }

    /**
     * Handle the login process.
     */
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in with provided credentials
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('profile.welcome');  // Redirect to the profile welcome page
        }

        // If authentication fails, throw a validation error
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register'); // Return the registration view
    }

    /**
     * Handle the registration process.
     */
    public function register(Request $request)
    {
        // Validate registration input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Prepare user data for creation
        $userData = $request->only('name', 'email');
        $userData['password'] = Hash::make($request->password);

        // Handle profile picture upload if available
        if ($request->hasFile('profile_picture')) {
            $userData['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        // Create the user
        $user = User::create($userData);

        // Automatically log in the user after registration
        Auth::login($user);

        // Redirect to profile welcome page after registration
        return redirect()->route('profile.welcome')->with('success', 'Account created successfully! Welcome!');
    }

    /**
     * Handle the logout process.
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Log out the user
        return redirect()->route('login'); // Redirect to the home page after logout
    }

    /**
     * Handle profile update process.
     */
    public function update(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'profile_picture_base64' => 'nullable|string', // For cropped base64 image
            'description' => 'nullable|string|max:500',
        ]);

        $user = Auth::user(); // Get the currently authenticated user

        // Update user data
        $user->name = $request->name;
        $user->email = $request->email;

        // Handle profile picture upload
        // Priority: base64 cropped image > direct file upload
        
        if ($request->filled('profile_picture_base64')) {
            // Handle base64 cropped image (from cropper)
            
            // Delete old profile picture if it exists
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            
            // Decode base64 image
            $imageData = $request->profile_picture_base64;
            
            // Remove the data:image/jpeg;base64, part
            $imageData = preg_replace('/^data:image\/\w+;base64,/', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $image = base64_decode($imageData);
            
            // Generate unique filename
            $filename = 'profile_' . $user->id . '_' . time() . '.jpg';
            
            // Save to storage/app/public/profile_pictures/
            $path = 'profile_pictures/' . $filename;
            Storage::disk('public')->put($path, $image);
            
            // Update user's profile_picture field
            $user->profile_picture = $path;
            
        } elseif ($request->hasFile('profile_picture')) {
            // Handle direct file upload (fallback if no cropping)
            
            // Delete old profile picture if it exists
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            
            $user->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        // Update description if provided
        $user->description = $request->description;
        $user->save(); // Save changes

        // Redirect to profile welcome page after update
        return redirect()->route('profile.welcome')->with('success', 'Profile updated successfully.');
    }

    public function welcome()
{
    return view('profile.index');
}
}

