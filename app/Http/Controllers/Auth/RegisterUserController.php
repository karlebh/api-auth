<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RegisterUserController extends Controller
{
  public function store(RegisterUserRequest $request): JsonResponse
  {
    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    $token = $user->createToken('Random Token')->accessToken;

    Auth::login($user);

    return response()->json(['token' => $token]);
  }
}
