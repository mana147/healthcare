<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class AdminLoginMidleware
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
        if(Auth::check())
        {
            $user = Auth::user();
            if($user->level == 'admin' || $user->level == 'manager')
            {
                return $next($request);
            }
            else
            {
                return redirect('admin/login');
            }
        }

        return redirect('admin/login');
    }
}
