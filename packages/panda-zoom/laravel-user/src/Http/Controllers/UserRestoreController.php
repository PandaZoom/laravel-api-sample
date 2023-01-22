<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Http\Controllers;

use App\Http\Controllers\Controller;
use PandaZoom\LaravelUser\Contracts\RestoreUserActionContract;
use PandaZoom\LaravelUser\Http\Resources\UserResource;
use PandaZoom\LaravelUser\Models\User;
use function app;

class UserRestoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function __invoke(User $user, RestoreUserActionContract $action): UserResource
    {
        $this->authorize('update', $user);

        app('db')->transaction(static fn() => $action->run($user));

        return new UserResource($user);
    }
}
