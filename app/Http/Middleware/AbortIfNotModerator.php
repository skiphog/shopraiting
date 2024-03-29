<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

class AbortIfNotModerator
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user() || !$request->user()->isModerator()) {
            if (!$request->expectsJson()) {
                return redirect('login');
            }

            abort(403);
        }

        return $next($request);
    }
}
