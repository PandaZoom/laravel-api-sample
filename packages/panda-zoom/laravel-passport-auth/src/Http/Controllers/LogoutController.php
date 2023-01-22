<?php
declare(strict_types=1);

namespace PandaZoom\LaravelPassportAuth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use function response;

class LogoutController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function __invoke(Request $request)
    {
        $request->user()?->token()?->revoke();

        return response()->json([], Response::HTTP_OK);
    }
}
