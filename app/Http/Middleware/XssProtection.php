<?php

namespace App\Http\Middleware;

use Closure;
use GrahamCampbell\Security\Facades\Security;

class XSSProtection
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
        if (!in_array(strtolower($request->method()), ['put', 'post', 'patch', 'get'])) 
        {
            return $next($request);
        }

        $input = $request->all();

        array_walk_recursive($input, function(&$input) {
            if (empty($input))
            {
                $input = '';
            }
            else
            {
                if (!(is_object($input) || is_numeric($input) || is_bool($input)))
                {
                    $input = Security::clean($input);
                }
            }
        });

        $request->merge($input);

        return $next($request);
    }
}
