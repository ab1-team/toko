<?php

namespace App\Http\Middleware;

use Closure;

class RedirectToDotCom
{
    public function handle($request, Closure $next)
    {
        $host = $request->getHost();

        if (substr($host, -4) !== '.com') {
            $newHost = preg_replace('/\.[^.]+$/', '.com', $host);
            $url = $request->getScheme() . '://' . $newHost . $request->getRequestUri();
            return redirect()->away($url, 301);
        }

        return $next($request);
    }
}
