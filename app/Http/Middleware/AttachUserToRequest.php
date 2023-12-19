<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AttachUserToRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        // Attach the authenticated user to the request if available 
        if ($user = auth()->user()) {
            $request->merge(['user' => $user]);
        }
        return $next($request);
    }
}
