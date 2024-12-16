<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Jobs\WelcomeEmail;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
        ]);

        if ($validation->fails()) {
            return response()->json(['message' => $validation->errors()->first()], 422);
        }

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make((string)$password),
        ]);

        $token = $user->createToken('api_token');

        WelcomeEmail::dispatch($user);

        return response()->json(['message' => "User created successfully with token: $token->plainTextToken"], 201);
    }

    public function show(User $user): JsonResponse
    {
        return response()->json($user);
    }
}
