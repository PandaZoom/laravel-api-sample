<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Http\Controllers;

use App\Http\Controllers\Controller;
use PandaZoom\LaravelCategory\Contracts\DeleteCategoryActionContract;
use PandaZoom\LaravelCategory\Contracts\GetCollectionCategoryActionContract;
use PandaZoom\LaravelCategory\Contracts\StoreCategoryActionContract;
use PandaZoom\LaravelCategory\Contracts\UpdateCategoryActionContract;
use PandaZoom\LaravelCategory\Http\Requests\CategoryIndexRequest;
use PandaZoom\LaravelCategory\Http\Requests\CategoryStoreRequest;
use PandaZoom\LaravelCategory\Http\Requests\CategoryUpdateRequest;
use PandaZoom\LaravelCategory\Http\Resources\CategoryCollection;
use PandaZoom\LaravelCategory\Http\Resources\CategoryResource;
use PandaZoom\LaravelCategory\Models\Category;
use Symfony\Component\HttpFoundation\Response;
use function app;
use function response;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')
            ->only(['store', 'update', 'destroy']);
    }

    public function index(CategoryIndexRequest $request, GetCollectionCategoryActionContract $action): CategoryCollection
    {
        $categories = $action->run($request->safe()->collect());

        return new CategoryCollection($categories);
    }

    public function store(CategoryStoreRequest $request, StoreCategoryActionContract $action)
    {
        $this->authorize('create', Category::class);

        $category = app('db')->transaction(static fn() => $action->run($request->validated()));

        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Category $category): CategoryResource
    {
        $this->authorize('view', $category);

        $category->withTranslation();

        return new CategoryResource($category);
    }

    public function update(CategoryUpdateRequest $request, Category $category, UpdateCategoryActionContract $action): CategoryResource
    {
        $this->authorize('update', $category);

        app('db')->transaction(static fn() => $action->run($category, $request->validated()));

        return new CategoryResource($category);
    }

    public function destroy(Category $category, DeleteCategoryActionContract $action)
    {
        $this->authorize('delete', $category);

        app('db')->transaction(static fn() => $action->run($category));

        return  response()->json([]);
    }
}
