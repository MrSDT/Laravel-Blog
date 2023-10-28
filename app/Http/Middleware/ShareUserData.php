<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
class ShareUserData
{

    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        View::share('currentUser', $user);

        return $next($request);
    }
}
