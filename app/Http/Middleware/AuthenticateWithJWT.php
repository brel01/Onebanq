<?php

// app/Http/Middleware/AuthenticateWithJWT.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateWithJWT
{
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {
            $user = Auth::guard('api')->user();
            $request->merge(['user' => $user]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid token'], 401);
        }

        $request->merge(['user' => $user]);

        // return response()->json(['error' => 'valid token', 's' =>  ['user' => $user]], 401);

        return $next($request);
    }
}


?>