<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CheckRole
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
        if ($request->user() === null) {
            $route = null;
            $segment = $request->segment(1);
            if ($segment == 'admin')
                $route = 'admin.login';
            if ($segment == 'seller')
                $route = 'seller.login';
            if ($segment == 'user')
                $route = 'signup';

            Session::put('requestedUri', $request->getPathInfo());

            return redirect()->route($route);
        }

        $actions = $request->route()->getAction();
        $roles = isset($actions['roles']) ? $actions['roles'] : null;

        if ($request->user()->hasAnyRole($roles) || !$roles) {
            return $next($request);
        }

        return redirect('/');
    }
}
