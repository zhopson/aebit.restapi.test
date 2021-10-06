<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use App\Models\User;

use Closure;

class EnsureTokenIsValid
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
        $value = $request->cookie('auth_token');
        if (!$value) {
            //return redirect('error',1);
            return redirect()->route('error', ['msg_id' => 1]);
        }

        return $next($request);
    }
}

