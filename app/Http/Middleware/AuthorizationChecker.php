<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;

class AuthorizationChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next) : Response
    {
        $token = $request->bearerToken();

        $data = Http::withToken($token)->get(env('AUTHORIZATHOR').'/api/getPermissions');

        $permissions = $data->json()[0]['permissions'];

        if ($data->failed()){
            return response()->json(['error' => 'Unexpected error'], 502);
        }

        $request->headers->set('HeaderX', $request['id']);

        $request->merge(['permissions' => $permissions]);
      
        return $next($request);
    }
}
