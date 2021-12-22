<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateApi
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
        if ($request->hasHeader('token')) {
            $token = Instructor::where('token', $request->header('token'))->first();
            if ($token) {
                return $next($request);
            }
            else
            {
                $response = [
                    'success' => false,
                    'message' => 'unauthorized'
                ];         
        
                return response()->json($response,403);
            }
        }else{
            $response = [
                'success' => false,
                'message' => 'unauthorized.'
            ];         
            return response()->json($response,403);            
        }
    }
        // return $next($request);
    // }
}
