<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class AuthController extends Controller
{
    public function register(Request $r)
    {
        $r->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:6',
            'role'=>'nullable|string|exists:roles,name'
        ]);

        $role = Role::where('name',$r->role ?? 'user')->first();

        $user = User::create([
            'name'=>$r->name,
            'email'=>$r->email,
            'password'=>bcrypt($r->password),
            'role_id'=>$role->id
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status'=>true,
            'message'=>'User registered',
            'user'=>$user,
            'token'=>$token
        ],201);
    }

    public function login(Request $r)
    {
        $user = User::where('email',$r->email)->first();
        if(!$user || !Hash::check($r->password,$user->password)){
            return response()->json(['status'=>false,'message'=>'Invalid credentials'],401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status'=>true,
            'message'=>'Login success',
            'user'=>$user,
            'token'=>$token
        ]);
    }

    public function logout(Request $r)
    {
        $r->user()->currentAccessToken()->delete();
        return response()->json(['status'=>true,'message'=>'Logged out']);
    }
}
