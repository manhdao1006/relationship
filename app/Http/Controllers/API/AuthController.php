<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    
    public function login()
    {
        try {
            request()->validate([
                'email' => 'required|email',
                'password' => 'required|min:8|max:20',
            ]);

            $user = User::query()->where('email', request('email'))->first();

            // check password
            if (!$user || !Hash::check(request('password'), $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            $token = $user->createToken($user->id)->plainTextToken; // string

            return response()->json([
                'token' => $token,
            ]);
        } catch (\Throwable $th) {
            if ($th instanceof ValidationException) {
                return response()->json([
                    'errors' => $th->errors(),
                ], Response::HTTP_BAD_REQUEST);
            }

            return response()->json([
                'errors' => $th->getMessage(),
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function register()
    {
        try {
            $data = request()->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8|max:20',
            ]);

            $user = User::create($data);

            $token = $user->createToken($user->id)->plainTextToken; // string

            return response()->json([
                'token' => $token,
            ]);
        } catch (\Throwable $th) {
            if ($th instanceof ValidationException) {
                return response()->json([
                    'errors' => $th->errors(),
                ], Response::HTTP_BAD_REQUEST);
            }

            return response()->json([
                'errors' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function logout()
    {
        try {
            request()->user()->currentAccessToken()->delete();

            return response()->json([
                'message' => 'Logout successfully!',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
