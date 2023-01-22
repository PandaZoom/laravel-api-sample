<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Http\Controllers;

use App\Http\Controllers\Controller;
use PandaZoom\LaravelCategory\Contracts\PatchCategoryActionContract;
use PandaZoom\LaravelCategory\Http\Requests\CategoryPatchRequest;
use PandaZoom\LaravelCategory\Http\Resources\CategoryResource;
use PandaZoom\LaravelCategory\Models\Category;
use function app;

class CategoryPatchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function __invoke(CategoryPatchRequest $request, Category $category, PatchCategoryActionContract $action): CategoryResource
    {
        $this->authorize('update', $category);

        app('db')->transaction(static fn() => $action->run($category, $request->validated()));

        return new CategoryResource($category);
    }
}
