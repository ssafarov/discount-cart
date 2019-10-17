<?php


    namespace App\Http\Middleware;

    use Closure;

    class Cors
    {
        public function handle($request, Closure $next)
        {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Key, Authorization, X-Csrf-Token, Access-Control-Allow-Origin');

            if( in_array($request->getMethod(), ['OPTIONS'])){
                header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PATCH, PUT, DELETE');
                header('Access-Control-Allow-Credentials: true');

                exit(0);
            }

            return $next($request);

        }
    }
