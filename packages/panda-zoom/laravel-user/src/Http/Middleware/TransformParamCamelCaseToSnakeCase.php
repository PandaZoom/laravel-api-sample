<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Http\Middleware;

use Closure;
use function request;

class TransformParamCamelCaseToSnakeCase
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  Closure $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, Closure $next)
    {
        if(request()?->has('firstName')){
            request()?->merge(['first_name' => request()?->get('firstName')]);
            request()->request->remove('firstName');
        }

        if(request()?->has('lastName')){
            request()?->merge(['last_name' => request()?->get('lastName')]);
            request()->request->remove('lastName');
        }

        return $next($request);
    }
}
