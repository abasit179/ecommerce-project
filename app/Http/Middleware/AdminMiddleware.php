<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::has('admin_logged_in') || !Session::get('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
