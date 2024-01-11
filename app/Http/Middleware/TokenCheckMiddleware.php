<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\AuthService;

class TokenCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        $authService = new AuthService();
        $token = $request->bearerToken();
        if(!$token){
            return response()->json(["message"=>"Token not found","data"=>[],"status"=>404]);
        }
        $tokenResponse = $authService->checkToken($token);
        if($tokenResponse['status']!=200){
            return response()->json(['message'=>'Token is invalid','data'=>[],'status'=>401]);
            
        }
        $request->merge(['user' => $tokenResponse['data']]);
        
        return $next($request);
    }
}
