<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Http\Controllers;

use App\Http\Controllers\Controller;
use PandaZoom\LaravelCategory\Contracts\RestoreCategoryActionContract;
use PandaZoom\LaravelCategory\Http\Resources\CategoryResource;
use PandaZoom\LaravelCategory\Models\Category;
use function app;

class CategoryRestoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function __invoke(Category $category, RestoreCategoryActionContract $action): CategoryResource
    {
        $this->authorize('update', $category);

        app('db')->transaction(static fn() => $action->run($category));

        return new CategoryResource($category);
    }
}
