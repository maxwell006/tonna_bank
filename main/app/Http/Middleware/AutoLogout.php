<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AutoLogout
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $settings = bs();

        if ($settings->auto_logout) {
            config([
                'session.lifetime' => ceil($settings->idle_timeout / 60)
            ]);
        }

        return $next($request);
    }
}
