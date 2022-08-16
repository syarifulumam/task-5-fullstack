<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        if($validator->fails()) return response()->json(['message' => $validator->errors()],422);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        $user = User::create($data);
        if($user){
            $token = $user->createToken('Token')->accessToken;
            return response()->json(['message' => 'Register Success','token' => $token]);
        }
        
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if($validator->fails()) return response()->json(['message' => $validator->errors()],422);

        if(Auth::attempt($request->only('email','password'))){
            $token = Auth::user()->createToken('Token')->accessToken;
            return response()->json([
                'message' => 'Login Success',
                'token' => $token,
            ]);
        } else {
            return response()->json([
                'message' => 'Wrong Email or Password',
            ]);
        }
    }
}
