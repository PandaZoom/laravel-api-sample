<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Http\Middleware;

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
        if(request()?->has('statusId')){
            request()?->merge(['status_id' => $request->get('statusId')]);
            request()->request->remove('statusId');
        }

        if(request()?->has('userId')){
            request()?->merge(['user_id' => $request->get('userId')]);
            request()->request->remove('userId');
        }

        if(request()?->has('categoryId')){
            request()?->merge(['category_id' => $request->get('categoryId')]);
            request()->request->remove('categoryId');
        }

        if(request()?->has('publishedAt')){
            request()?->merge(['published_at' => $request->get('publishedAt')]);
            request()->request->remove('publishedAt');
        }

        if(request()?->has('expiresAt')){
            request()?->merge(['expires_at' => $request->get('expiresAt')]);
            request()->request->remove('expiresAt');
        }

        return $next($request);
    }
}
