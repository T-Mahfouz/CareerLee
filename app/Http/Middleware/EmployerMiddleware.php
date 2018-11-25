<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Support\Facades\Auth;

class EmployerMiddleware
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
        if(Auth::user()->role->name != 'employer')
        {
            if($request->wantsJson())
                return Controller::jsonResponse(401,'Unauthorized, user not Employer.');

            return redirect('/');
        }

        return $next($request);
    }
}
