<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;

class GetMobile
{
    public function hundle($request, Closure $next)
    {
        $isMobile = false;
        $user_agent =  $request->header('User-Agent');
        if ((strpos($user_agent, 'iPhone') !== false)
            || (strpos($user_agent, 'iPod') !== false)
            || (strpos($user_agent, 'Android') !== false)) {
            $isMobile = true;
        }
        View::share('isMobile', $isMobile);
        return $next($request);
    }
}