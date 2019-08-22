<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use \App\Http\Controllers\UserController as UserController;

class User
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
        $myData = UserController::myData();
        if($myData == "") {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
