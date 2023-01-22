<?php

namespace PandaZoom\LaravelBase\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use function throw_if;

class HeaderAcceptJson
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws \Throwable
     */
    public function handle($request, Closure $next): mixed
    {
        throw_if(
            ! $request->wantsJson(),
            NotFoundHttpException::class
        );

        return $next($request);
    }
}
