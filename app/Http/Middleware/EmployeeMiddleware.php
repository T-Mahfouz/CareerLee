<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Support\Facades\Auth;

class EmployeeMiddleware
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
        if(Auth::user()->role->name != 'employee')
        {
            if($request->wantsJson())
                return Controller::jsonResponse(401,'Unauthorized, user not Employee.');

            return redirect('/');
        }

        return $next($request);
    }
}
