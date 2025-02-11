<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $email = strtolower($request->email);
        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken($user->name . ' auth_token')->plainTextToken;

        return response()->json([
            'success' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ], 200);
    }
    public function register(RegisterRequest $request)
    {
        $userEmail = User::where('email', $request->email)->first();

        if ($userEmail) {
            return response()->json(['error' => 'Email already exists'], 409);
        }

        $user = User::create([
            'name' => strtolower($request->name),
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken($user->name . ' auth_token')->plainTextToken;

        return response()->json([
            'success' => 'Registration successful',
            'access_token' => $token,
            'token_type' => 'Bearer'
        ], 201);
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logout successful'], 200);
    }
    public function profile(Request $request)
    {
        return response()->json([
            'message' => 'Profile fetched successfully',
            'data' => $request->user()
        ], 200);
    }
    public function updateProfile(Request $request, $id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json([
                    'message' => 'User Not Found.'
                ], 404);
            }

            // Validate incoming request data
            $validatedData = $request->validate([
                'name' => 'nullable|string|max:255',
                'email' => 'nullable|email|unique:users,email,' . $user->id,
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'password' => 'nullable|min:8|confirmed',
            ]);

            // Update name
            if ($request->has('name')) {
                $user->name = Str::lower($validatedData['name']);
            }

            // Update email
            if ($request->has('email')) {
                $user->email = Str::lower($validatedData['email']);
            }

            // Handle profile image update
            if ($request->hasFile('image')) {
                $storage = Storage::disk('public');

                // Delete old image if exists and is not empty
                if ($user->image && $storage->exists($user->image)) {
                    $storage->delete($user->image);
                }

                // Generate unique image name inside 'profile' folder
                $imageName = 'profile/' . Str::random(32) . "." . $request->image->getClientOriginalExtension();
                $storage->put($imageName, file_get_contents($request->image->getRealPath()));

                $user->image = $imageName;
            }

            // Update password only if provided
            if ($request->filled('password')) {
                $user->password = Hash::make($validatedData['password']);
            }

            // Save updated user details
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully.',
                'user' => $user
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => "Validation failed.",
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Error updating profile: ' . $e->getMessage(), ['exception' => $e]);

            return response()->json([
                'message' => "Something went wrong!",
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function deleteAccount(Request $request)
    {
        $user = $request->user();

        $user->delete();

        $request->user()->tokens()->delete();

        return response()->json([
            'success' => 'Account deleted successfully'
        ], 200);
    }
    public function getAllUsers(Request $request)
    {
        $users = User::where('role', 'user')->get()->toArray();

        return response()->json($users, 200);
    }
    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['success' => 'User deleted successfully'], 200);
    }
}