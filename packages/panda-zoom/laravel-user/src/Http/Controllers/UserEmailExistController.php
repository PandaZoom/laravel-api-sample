<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Http\Controllers;

use App\Http\Controllers\Controller;
use PandaZoom\LaravelUser\Http\Requests\UserEmailExistRequest;
use function response;

class UserEmailExistController extends Controller
{
    public function __invoke(UserEmailExistRequest $request)
    {
        return response()->json();
    }
}
