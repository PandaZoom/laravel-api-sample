<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use PandaZoom\LaravelUser\Contracts\DeleteUserActionContract;
use PandaZoom\LaravelUser\Models\User;
use function app;
use function class_exists;
use function response;

class_exists(User::class);

class UserDeleteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function __invoke(User $user, DeleteUserActionContract $action): JsonResponse
    {
        $this->authorize('delete', $user);

        app('db')->transaction(static fn() => $action->run($user, true));

        return response()->json([]);
    }
}
