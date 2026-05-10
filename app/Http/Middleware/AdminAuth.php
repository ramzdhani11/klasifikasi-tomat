<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if admin is logged in via session
        if (!session('admin_logged_in')) {
            // If it's an AJAX request, return JSON error
            if ($request->wantsJson()) {
                return response()->json([
                    'error' => 'Unauthorized - Silakan login terlebih dahulu'
                ], 403);
            }
            
            // Otherwise redirect to login page
            return redirect()->route('admin.login')
                ->with('error', 'Silakan login sebagai admin terlebih dahulu');
        }

        return $next($request);
    }
}
