<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Http\Middleware;

use Closure;
use function request;

class TransformParamCamelCaseToSnakeCase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if(request()?->has('userId')){
            request()?->merge(['user_id' => $request->get('userId')]);
            request()->request->remove('userId');
        }

        return $next($request);
    }
}
