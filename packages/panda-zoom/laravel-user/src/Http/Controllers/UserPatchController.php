<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Http\Controllers;

use App\Http\Controllers\Controller;
use PandaZoom\LaravelUser\Contracts\UpdateUserActionContract;
use PandaZoom\LaravelUser\Http\Middleware\TransformParamCamelCaseToSnakeCase;
use PandaZoom\LaravelUser\Http\Requests\UserPatchRequest;
use PandaZoom\LaravelUser\Http\Resources\UserResource;
use PandaZoom\LaravelUser\Models\User;
use function app;

class UserPatchController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'auth:api',
            TransformParamCamelCaseToSnakeCase::class
        ]);
    }

    public function __invoke(UserPatchRequest $request, User $user, UpdateUserActionContract $action): UserResource
    {
        $this->authorize('update', $user);

        app('db')->transaction(static fn() => $action->run($user, $request->validated()));

        return new UserResource($user);
    }
}
