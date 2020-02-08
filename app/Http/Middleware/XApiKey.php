<?php

namespace App\Http\Middleware;

use App\Models\ApiKeys;
use Closure;

class XApiKey
{
    const AUTH_HEADER = 'X-API-KEY';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $header = $request->header(self::AUTH_HEADER);
        $apiKey = ApiKeys::getByKey($header);

        if ($apiKey instanceof ApiKeys) {
            return $next($request);
        }

        return response()->json([
                'status' => 'error',
                'message' => 'Invalid X-API-KEY'
            ], 401
        );
    }
}
