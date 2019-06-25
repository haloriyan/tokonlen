<?php

namespace App\Http\Middleware;

use Closure;
use \App\Http\Controllers\AdminController as AdminController;

class Admin
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
        $myData = AdminController::myData();
        if($myData == "") {
            return redirect()->route('user.index');
        }
        return $next($request);
    }
}
