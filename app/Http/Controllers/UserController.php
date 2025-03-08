<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|string|min:8|confirmed',
        ]);

        $user->update($request->only(['name', 'email', 'password']));

        return response()->json($user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }

    public function uploadProfilePicture(Request $request)
    {
        // Validate request (ensure file is an image)
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Get authenticated user (Change this to get the correct user)
        $user = User::find(1); // Change this to get the logged-in user dynamically

        // Store file in "storage/app/public/profile_pictures"
        $path = $request->file('profile_picture')->store('public/profile_pictures');

        // Remove "public/" from the path before saving to database
        $path = str_replace('public/', '', $path);

        // Save the file path in database
        $user->profile_picture = $path;
        $user->save();

        return response()->json([
            'message' => 'Profile picture uploaded successfully!',
            'path' => asset('storage/' . $path),
        ]);
    }

    public function uploadICPassport(Request $request)
    {
        $request->validate([
            'ic_passport' => 'required|mimes:pdf,jpg,png|max:2048',
        ]);

        $file = $request->file('ic_passport');
        $path = $file->store('private/ic_passports', 'local');

        $user = auth()->user();
        $user->ic_passport_path = $path;
        $user->save();

        return response()->json(['message' => 'File uploaded successfully', 'path' => $path]);
    }

    public function downloadICPassport()
    {
        $user = auth()->user();
        if (!$user->ic_passport_path || !Storage::exists($user->ic_passport_path)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        return Storage::download($user->ic_passport_path);
    }
}
