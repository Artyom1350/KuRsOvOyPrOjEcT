<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class tokenAdmin
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
        // dd(PersonalAccessToken::where('token',$request->post('token'))->first()->name);
        if((PersonalAccessToken::where('token',$request->post('token'))->first()->name)!="admin") {
            return response()->json(['message' => 'Access is denied'], 401);
        }
        return $next($request);
    }
}
