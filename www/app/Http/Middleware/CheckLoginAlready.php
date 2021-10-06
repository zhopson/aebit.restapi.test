<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

use Closure;
use App\Models\User;

class CheckLoginAlready
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
        $input = $request->all();
        $cookie_req = $request->cookie('auth_token');
        $usermail = $input['email'];
        $user = User::where('email', $usermail)->first();
        
        if ($user && $cookie_req === $user->api_token) {
            return redirect()->route('error', ['msg_id' => 2]);
            //return redirect('error',2);
        }

        return $next($request);
    }
}

