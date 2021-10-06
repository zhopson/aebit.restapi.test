<?php

namespace App\Http\Middleware;

//use Illuminate\Http\Request;

use Closure;

class CheckLogoutAlready
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        $cookie_req = $request->cookie('auth_token');
        if (!$cookie_req) {
            //eturn redirect('error',4);
            return redirect()->route('error', ['msg_id' => 4]);
        }

        return $next($request);
    }
}

