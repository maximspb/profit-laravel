<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckUsernameAndPassword
{
    private const ADMIN_USERNAME = 'admin';
    private const PASSWORD = '123456';

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if (
            self::ADMIN_USERNAME !== $request->header('X-UserName')
            ||
            false === password_verify(self::PASSWORD, $request->header('X-Password'))
        ) {
            return \response(status: Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
