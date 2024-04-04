<?php

namespace App\Http\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            'nama_lengkap' => 'required',
            'username' => 'required|unique:users',
            // 'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan,Lainnya',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'no_telp' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ada kesalahan',
                'data' => $validator->errors()
            ], 400);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['confirm_password'] = Hash::make($input['confirm_password']);
        $user = User::create($input);

        $token = $user->createToken('auth_token')->plainTextToken;
        $success['token'] = $token;
        $success['username'] = $user->username;

        return response()->json([
            'success' => true,
            'message' => 'Sukses register',
            'data' => $success
        ], 200);
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $auth = Auth::user();
            $success['token'] = $auth->createToken('auth_token')->plainTextToken;
            $success['username'] = $auth->username;
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
