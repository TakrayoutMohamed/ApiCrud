<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //register new admin
    public function register(Request $request)
    {
        $data=$request->validate([
            'name'=>'required|string|max:199',
            'email'=>'required|email|unique:users',
            'password'=>'required|string'
        ]);

        $user = User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password'])
        ]);

        $token = $user->createToken('codeTokenRegister')->plainTextToken;

        $response=[
            'user'=>$user,
            'token'=>$token
        ];
        return response($response,201);
                
    }
    //log out an admin

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response(['message'=>'logout successfully'],200);
    }

    // login an admin

    public function login(Request $request)
    {
        $data=$request->validate([
            'email'=>'required|email',
            'password'=>'required|string'
        ]);

        $user = User::where('email',$data['email'])->first();

        if(!$user || !Hash::check($data['password'],$user->password))
        {
            return response(['message'=>'password or email not correct'],401);
        }
        else
        {
            $token = $user->createToken('codeTokenLogin')->plainTextToken;
            $response =[
                'user'=>$user,
                'token'=>$token
            ];
            return response($response,200);
        }
    }
}
