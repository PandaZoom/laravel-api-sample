<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Http\Controllers;

use App\Http\Controllers\Controller;
use PandaZoom\LaravelStatus\Contracts\StatusCollectionActionContract;
use PandaZoom\LaravelStatus\Contracts\DeleteStatusActionContract;
use PandaZoom\LaravelStatus\Contracts\StoreStatusActionContract;
use PandaZoom\LaravelStatus\Contracts\UpdateStatusActionContract;
use PandaZoom\LaravelStatus\Contracts\ShowStatusActionContract;
use PandaZoom\LaravelStatus\Http\Middleware\TransformParamCamelCaseToSnakeCase;
use PandaZoom\LaravelStatus\Http\Requests\StatusIndexRequest;
use PandaZoom\LaravelStatus\Http\Requests\StatusStoreRequest;
use PandaZoom\LaravelStatus\Http\Requests\StatusUpdateRequest;
use PandaZoom\LaravelStatus\Http\Resources\StatusCollection;
use PandaZoom\LaravelStatus\Http\Resources\StatusResource;
use PandaZoom\LaravelStatus\Models\Status;
use PandaZoom\LaravelStatus\Http\Requests\StatusDeleteRequest;
use Symfony\Component\HttpFoundation\Response;
use function app;
use function class_exists;

class_exists(StatusIndexRequest::class);
class_exists(StatusUpdateRequest::class);
class_exists(StatusCollection::class);
class_exists(StatusResource::class);
class_exists(Status::class);

class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')
            ->only(['store', 'update', 'destroy']);

        $this->middleware(TransformParamCamelCaseToSnakeCase::class)->only(['index', 'store', 'update']);
    }

    public function index(StatusIndexRequest $request, StatusCollectionActionContract $action)
    {
        $users = $action->run($request->safe()->collect());

        return new StatusCollection($users);
    }

    public function show(Status $status, ShowStatusActionContract $action): StatusResource
    {
        $this->authorize('view', $status);

        $action->run($status);

        return new StatusResource($status);
    }

    public function store(StatusStoreRequest $request, StoreStatusActionContract $action)
    {
        $this->authorize('create', Status::class);

        $status = $action->run($request->safe()->collect());

        return (new StatusResource($status))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(StatusUpdateRequest $request, Status $status, UpdateStatusActionContract $action): StatusResource
    {
        $this->authorize('update', $status);

        app('db')->transaction(static fn() => $action->run($status, $request->safe()->collect()));

        return new StatusResource($status);
    }

    public function destroy(StatusDeleteRequest $request,  Status $status, DeleteStatusActionContract $action)
    {
        $this->authorize('delete', $status);

        app('db')->transaction(static fn() => $action->run($status, $request->validated()['permanent'] ?? false));

        return response()->json([]);
    }
}
