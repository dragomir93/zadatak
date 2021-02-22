<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class TokenAuth
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
        $token = $request->header('API-TOKEN');

        if(!$token) abort(401 , 'No token!');

        $user = User::tokenExists($token);

        if(!$user) abort(401, 'Token does not match any user!');

       

        return $next($request);
    }
}
