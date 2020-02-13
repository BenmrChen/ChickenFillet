<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log; // 用log的話要use這個

class OpayPaymentLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        Log::info([
            $request->header(),
            $request->getMethod(),
            $request->getRequestUri(),
            $request->all(),
            $response->getStatusCode(),
            $response->getContent()
        ]);
        return $response;

//        return $next($request);
    }
}
