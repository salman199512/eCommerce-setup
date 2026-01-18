<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

class SetUserCookie
{
    public function handle($request, Closure $next)
    {

        if (empty($request->cookie('user_id'))) {
            $rndno = $this->generateRandomString(16);

            $cookie_name = "user_id";
            $cookie_value = $rndno;

            // Create a new cookie instance
            $cookie = cookie($cookie_name, $cookie_value, 30 * 24 * 60); // 30 days
            // Attach the cookie to the response
            return $next($request)->withCookie($cookie);
        }

        return $next($request);
    }

    private function generateRandomString($val)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $val; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
