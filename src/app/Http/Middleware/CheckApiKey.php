<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $keys = config('app.api_keys');
        
        if (!$request->header('x-api-key')) {
            return response()->json([
                "error" => "Forbidden: Missing Api-Key in the request",
            ], 403);
        }
        
        if (!in_array($request->header('x-api-key'), $keys)) {
            return response()->json([
                "error" => "Forbidden: Invalid Api-Key in the request",
            ], 403);
        }

        return $next($request);
    }
}
