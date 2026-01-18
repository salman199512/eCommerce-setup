<?php

namespace App\Http\Middleware;

use App\MyClasses\ApiHelpers;
use Closure;
use Illuminate\Http\Request;

class ApiAuthMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {

        $bearer_token = explode(" ", $request->header('authorization'));

        $token = isset($bearer_token[0]) ? $bearer_token[0] : '';

        if ($token == 'R0dVLVRhbGsgMjAyNSBGb3IgU2VjcmV0ZQ==') {
            return $next($request);
        } else {
            return ApiHelpers::response('Unauthorized user!', [], 401);
        }
    }
}
