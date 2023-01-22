<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Http\Controllers;

use App\Http\Controllers\Controller;
use PandaZoom\LaravelUser\Contracts\UpdateUserActionContract;
use PandaZoom\LaravelUser\Http\Middleware\TransformParamCamelCaseToSnakeCase;
use PandaZoom\LaravelUser\Http\Requests\UserPatchRequest;
use PandaZoom\LaravelUser\Http\Resources\UserResource;
use function app;

class ProfilePatchController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'auth:api',
            TransformParamCamelCaseToSnakeCase::class
        ]);
    }

    public function __invoke(UserPatchRequest $request, UpdateUserActionContract $action)
    {
        $this->authorize('update', $request->user());

        app('db')->transaction(static fn() => $action->run($request->user(), $request->validated()));

        return new UserResource($request->user());
    }
}
