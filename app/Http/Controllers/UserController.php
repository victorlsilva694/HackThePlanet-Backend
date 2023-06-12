<?php

namespace App\Http\Controllers;

use Firebase\JWT\Key;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Firebase\JWT\JWT;

class UserController extends Controller
{
    public function administrationTravels()
    {
        return $this->hasMany(AdministrationTravel::class);
    }
    
    public function AuthenticateUser(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $this->generateJWT($user);
            return response()->json(['token' => $token, 'email' => $user->email, 'id' => $user->id, 'username' => $user->name]);
        }
    }

    public function jwtValidateInRealTime(Request $request)
    {
        $token = $request->input('token');
        $key = env('JWT_SECRET');

        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid token'], 400);
        }

        $user = User::find($decoded->sub);

        return response()->json(['token' => $token, "decoded" => $user]);
    }

    private function generateJWT($user)
    {
        $payload = [
            'sub' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'iat' => time(),
            'exp' => time() + 60 * 180
        ];

        $jwt = JWT::encode($payload, env('JWT_SECRET'), 'HS256');

        return $jwt;
    }

    public function RegisterUser(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            } else {
                $user = new User;

                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->password = bcrypt($request->input('password'));

                $user->save();

                return response()->json([
                    'message' => 'User created successfully'
                ], 201);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create user'
            ], 500);
        }
    }
}
