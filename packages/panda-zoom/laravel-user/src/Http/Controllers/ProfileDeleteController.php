<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PandaZoom\LaravelUser\Contracts\DeleteUserActionContract;
use function app;
use function response;

class ProfileDeleteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function __invoke(Request $request, DeleteUserActionContract $action)
    {
        $this->authorize('delete', $request->user());

        app('db')->transaction(static fn() => $action->run($request->user(), true));

        return response()->json();
    }
}
