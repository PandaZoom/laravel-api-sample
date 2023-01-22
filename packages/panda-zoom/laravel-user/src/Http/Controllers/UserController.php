<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Relations\HasMany;
use PandaZoom\LaravelBase\Actions\LoadModelRelationByRequestAction;
use PandaZoom\LaravelUser\Contracts\CursorPaginateUserActionContract;
use PandaZoom\LaravelUser\Contracts\DeleteUserActionContract;
use PandaZoom\LaravelUser\Contracts\UpdateUserActionContract;
use PandaZoom\LaravelUser\Http\Middleware\TransformParamCamelCaseToSnakeCase;
use PandaZoom\LaravelUser\Http\Requests\UserIndexRequest;
use PandaZoom\LaravelUser\Http\Requests\UserUpdateRequest;
use PandaZoom\LaravelUser\Http\Resources\UserCollection;
use PandaZoom\LaravelUser\Http\Resources\UserResource;
use PandaZoom\LaravelUser\Models\User;
use function app;
use function class_exists;

class_exists(UserIndexRequest::class);
class_exists(UserUpdateRequest::class);
class_exists(UserCollection::class);
class_exists(UserResource::class);
class_exists(User::class);

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')
            ->only(['update', 'destroy']);

        $this->middleware(TransformParamCamelCaseToSnakeCase::class)->only(['index', 'update']);
    }

    public function index(UserIndexRequest $request, CursorPaginateUserActionContract $action)
    {
        $users = $action->run($request->safe()->collect());

        return new UserCollection($users);
    }

    public function show(User $user): UserResource
    {
        $this->authorize('view', $user);

        app(LoadModelRelationByRequestAction::class)->run($user, [
            'language',
            'articles' => static fn(HasMany $q) => $q->withTranslation(),
            'article' => static fn(HasMany $q) => $q->withTranslation(),
        ]);

        return new UserResource($user);
    }

    public function update(UserUpdateRequest $request, User $user, UpdateUserActionContract $action): UserResource
    {
        $this->authorize('update', $user);

        app('db')->transaction(static fn() => $action->run($user, $request->validated()));

        return new UserResource($user);
    }

    public function destroy(User $user, DeleteUserActionContract $action)
    {
        $this->authorize('delete', $user);

        app('db')->transaction(static fn() => $action->run($user));

        return response()->json();
    }
}
