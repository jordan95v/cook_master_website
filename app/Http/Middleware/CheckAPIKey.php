<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAPIKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $key = $request->header("API_KEY");
        if (!$key) {
            return response()->json(["error" => "Missing API key."], 401);
        }
        if (!User::where("api_key", $key)->first()) {
            return response()->json(["error" => "Invalid API key."], 401);
        }
        return $next($request);
    }
}
