<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Exceptions\V1\CustomException;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {

            try{
                $credentials = $request->validate([
                    'email' =>  'required|email',
                    'password' => 'required',
                ]);
            } catch (ValidationException $e) {
                // Custom response for validation failure
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $e->errors(),
                ], 422);
            }


            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                // $token = $user->createToken('oneBanq')->accessToken;

                return response()->json([
                    'user' =>  [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'phone' => $user->phone,
                    ],
                    // 'token' => $token
                ], 200);
            }

            return response()->json([
                    'error' => 'Invalid crednetials'
            ], 401);        
        } catch (\Exception $e){
            return response()->json([
                'status' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function logout(Request $request)
    {
        try {
            // Revoke the users token
            $request->user('api')->tokens()->each(function ($token) {
                $token->delete();
            });
    
            return response()->json([
                'message' => 'Successfully logged out',
            ], 200);
        } catch (\Exception $e) {
            // Log the exception 
            \Log::error('Logout error: ' . $e->getMessage());
    
            return response()->json([
                'status' => 500,
                'message' => 'Error during logout process',
            ], 500);
        }
    }
}

?>