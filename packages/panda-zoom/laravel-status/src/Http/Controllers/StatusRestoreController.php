<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Http\Controllers;

use App\Http\Controllers\Controller;
use PandaZoom\LaravelStatus\Contracts\RestoreStatusActionContract;
use PandaZoom\LaravelStatus\Http\Resources\StatusResource;
use PandaZoom\LaravelStatus\Models\Status;
use function app;

class StatusRestoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function __invoke(Status $status, RestoreStatusActionContract $action): StatusResource
    {
        $this->authorize('update', $status);

        app('db')->transaction(static fn() => $action->run($status));

        return new StatusResource($status);
    }
}
