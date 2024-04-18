<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\LoginUserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class LoginUserController extends Controller
{
  public function store(LoginUserRequest $request): JsonResponse
  {
    if (!Auth::attempt(($request->validated()))) {
      return ['message' => 'Incorrect data. Try again'];
    }

    $request->session()->regenerate();

    $token  = $request->user()->createToken('Random Token')->accessToken;

    return response()->json(['token' => $token]);
  }

  public function destroy(Request $request): JsonResponse
  {
    auth()->user()->token()->revoke();

    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return response()->json(['message' => 'User Logged Out']);
  }
}
