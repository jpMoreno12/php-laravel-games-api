<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;

class AuthenticatorChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next) : Response
    {
        $token = $request->bearerToken();

        $data = Http::withToken($token)->get('http://127.0.0.1:8000/api/user/check');

        if ($data->failed()){
            return response()->json(['erro' => 'Token inválido'],
            $data->status());
        }

        $request->merge($data->json());

        return $next($request);
    }
}