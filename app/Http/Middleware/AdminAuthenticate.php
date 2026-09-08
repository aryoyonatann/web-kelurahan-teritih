<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::guard('admin')->check()) {
            // Kalau request AJAX / expects JSON → kembalikan 401 JSON, bukan redirect HTML
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['message' => 'Unauthenticated. Silakan login ulang.'], 401);
            }
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}