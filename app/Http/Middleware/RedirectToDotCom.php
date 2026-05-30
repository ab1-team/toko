<?php

namespace App\Http\Middleware;

use Closure;

class RedirectToDotCom
{
    public function handle($request, Closure $next)
    {
        $host = $request->getHost();

        if (!str_ends_with($host, '.com')) {
            $newHost = preg_replace('/\.[^.]+$/', '.com', $host);
            $url = $request->getScheme() . '://' . $newHost . $request->getRequestUri();
            return redirect()->away($url, 301);
        }

        return $next($request);
    }
}
