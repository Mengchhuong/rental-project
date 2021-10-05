<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CORS
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        // return $next($request)
        // $response->header('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, PATCH, DELETE')
        // $response->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'))
        // $response->header('Access-Control-Allow-Origin', '*')
        // // ->header('Access-Control-Allow-Origin', '*')
        // // ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        // // -> header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS')
        // // -> header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Accept,charset,boundary,Content-Length')
        // return $response;
        $response = $next($request);
        $response->header('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, PATCH, DELETE');
        $response->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));
        $response->header('Access-Control-Allow-Origin', '*');
        $response->header('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Application');
        return $response;

    }
}
