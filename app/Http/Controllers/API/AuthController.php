<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if($user){
            return response()->json([
                'message' => 'Email sudah digunakan'
            ], 401);
        }

        $request->password = Hash::make($request->password);
        $upload = User::create($request->all());

        return response()->json([
            'message' => 'User berhasil didaftarkan',
            'data' => $upload
        ], 200);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();


        if(!$user){
            return response()->json([
                'message' => 'User tidak ditemukan',
                'code' => '400'
            ], 400);
        }else if(!Hash::check($user->password, $request->password)){
            return response()->json([
                'message' => 'Password tidak sesuai',
                'code' => '400'
            ], 400);
        }

        $token = $user->createToken('token-name')->plainTextToken;

        return response()->json([
            'message' => 'success',
            'data' => $user,
            'token' => $token
        ], 200);
    }
}