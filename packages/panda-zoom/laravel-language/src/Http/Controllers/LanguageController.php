<?php
declare(strict_types=1);

namespace PandaZoom\LaravelLanguage\Http\Controllers;

use App\Http\Controllers\Controller;
use PandaZoom\LaravelLanguage\Http\Requests\LanguageIndexRequest;
use PandaZoom\LaravelLanguage\Http\Resources\LanguageCollection;
use PandaZoom\LaravelLanguage\Tasks\GetLanguageCollectionTask;

class LanguageController extends Controller
{
    public function __invoke(LanguageIndexRequest $request, GetLanguageCollectionTask $task)
    {
        $models = $task->run($request->safe()->collect());

        return new LanguageCollection($models);
    }
}
