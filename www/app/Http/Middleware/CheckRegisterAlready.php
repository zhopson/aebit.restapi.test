<?php

namespace App\Http\Middleware;

//use Illuminate\Http\Request;

use Closure;
use App\Models\User;

class CheckRegisterAlready
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
        $input = $request->all();
        $usermail = $input['email'];
        $user = User::where('email', $usermail)->first();
        
        if ($user && $usermail === $user->email) {
            return redirect()->route('error', ['msg_id' => 3]);
//            return redirect('error',3);
        }

        return $next($request);
    }
}

