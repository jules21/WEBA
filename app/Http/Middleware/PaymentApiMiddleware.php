<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PaymentApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('token');
        if (! $token) {
            return response()->json(['message' => 'Please set custom header', 'status' => 6], 401);
        } else {
            if ($token != '9c44474c76b107f84aeb4b827cccf38e') {
                return response()->json(['message' => 'Invalid token', 'status' => 6], 401);
            }
        }

        return $next($request);
    }
}
