<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PandaZoom\LaravelBase\Actions\LoadModelRelationByRequestAction;
use PandaZoom\LaravelUser\Contracts\DeleteUserActionContract;
use PandaZoom\LaravelUser\Contracts\UpdateUserActionContract;
use PandaZoom\LaravelUser\Http\Middleware\TransformParamCamelCaseToSnakeCase;
use PandaZoom\LaravelUser\Http\Requests\UserUpdateRequest;
use PandaZoom\LaravelUser\Http\Resources\UserResource;
use function app;
use function response;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware(TransformParamCamelCaseToSnakeCase::class)->only('update');
    }

    public function show(Request $request): UserResource
    {
        $this->authorize('view', $request->user());

        app(LoadModelRelationByRequestAction::class)->run($request->user(), ['language']);

        return new UserResource($request->user());
    }

    public function update(UserUpdateRequest $request, UpdateUserActionContract $action)
    {
        $this->authorize('update', $request->user());

        app('db')->transaction(static fn() => $action->run($request->user(), $request->validated()));

        return new UserResource($request->user());
    }

    public function destroy(Request $request, DeleteUserActionContract $action): JsonResponse
    {
        $this->authorize('delete', $request->user());

        app('db')->transaction(static fn() => $action->run($request->user()));

        return response()->json();
    }
}
