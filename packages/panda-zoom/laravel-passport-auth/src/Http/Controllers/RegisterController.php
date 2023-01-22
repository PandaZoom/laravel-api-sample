<?php
declare(strict_types=1);

namespace PandaZoom\LaravelPassportAuth\Http\Controllers;

use function app;
use App\Http\Controllers\Controller;
use function class_exists;
use PandaZoom\LaravelPassportAuth\Contracts\RegisterNewUserActionContract;
use PandaZoom\LaravelPassportAuth\Http\Requests\RegisterUserRequest;
use function response;
use Symfony\Component\HttpFoundation\Response;

class_exists(RegisterUserRequest::class);

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function __invoke(RegisterUserRequest $request, RegisterNewUserActionContract $action)
    {
        $token = app('db')->transaction(static fn () => $action->run($request->safe()->collect()));

        return response()->json($token, Response::HTTP_CREATED);
    }
}
