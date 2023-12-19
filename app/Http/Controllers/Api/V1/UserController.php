<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\V1\CustomException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function register(Request $request){                  
        try {
            
            try {
                $validatedData = $request->validate([
                    'name' => 'required|string',
                    'email' => 'required|email|unique:users',
                    'phone' => 'required|string',
                    // 'phone' => ['required', Rule::phone()->country('+234')],
                    'password' => 'required|min:6',
                ]);
        
                // If validation passes, continue processing the request
                // ...
            } catch (ValidationException $e) {
                // Custom response for validation failure
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $e->errors(),
                ], 422);
            }

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'password' => bcrypt($validatedData['password']),
            ]);

            $token = $user->createToken('oneBanq')->accessToken;

            return response()->json(['user' => $user, 'token' => $token], 201);

            // CustomException('Error message', REQUEST_NOT_VALID);'  

        } catch (CustomException $e){
            return response()->json([
                'status' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }
    }
}
