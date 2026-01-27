<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Allow only authenticated admin users.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $userType = strtolower((string) (Auth::user()->usertype ?? ''));
        if ($userType !== 'admin') {
            abort(403);
        }

        return $next($request);
    }
}

