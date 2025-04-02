<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Fungsi untuk login
    public function login(Request $request)
    {
        // Validasi inputan
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        // Mencari user berdasarkan email
        $user = User::where('email', $validated['email'])->first();

        // Mengecek apakah user ditemukan dan password benar
        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Membuat token untuk user
        $token = $user->createToken('api')->plainTextToken;

        // Mengembalikan response dengan token
        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
        ], 200);
    }
}
