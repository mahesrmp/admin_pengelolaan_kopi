<?php

namespace App\Http\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     if (auth()->attempt($credentials)) {
    //         $user = auth()->user();
    //         $token = $user->createToken('API Token')->accessToken;

    //         return response()->json(['token' => $token], 200);
    //     } else {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }
    // }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ada kesalahan',
                'data' => $validator->errors()
            ]);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        // $success['token'] = $user->createToken('auth_token')->plainTextToken;
        $success['username'] = $user->username;

        return response()->json([
            'success' => true,
            'message' => 'Sukses register',
            'data' => $success
        ]);
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $auth = Auth::user();
            // $success['token'] = $auth->createToken('auth_token')->plainTextToken;
            $success['username'] = $auth->username;
            $success['email'] = $auth->email;
            $success['id'] = $auth->id;

            return response()->json([
                'success' => true,
                'message' => 'Login sukses',
                'data' => $success
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cek username dan password lagi',
                'data' => null
            ]);
        }
    }
}
