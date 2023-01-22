<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Http\Middleware;

use Closure;
use PandaZoom\LaravelUser\Exceptions\UserIsDeactivatedException;
use function throw_if;

class CheckUserIsDeactivated
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
            $request->user()?->active === false,
            UserIsDeactivatedException::class,
        );

        return $next($request);
    }
}
