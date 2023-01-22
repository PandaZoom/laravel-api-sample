<?php
declare(strict_types=1);

namespace PandaZoom\LaravelLanguage\Http\Controllers;

use App\Http\Controllers\Controller;
use PandaZoom\LaravelLanguage\Http\Requests\LanguagePatchRequest;
use PandaZoom\LaravelLanguage\Http\Resources\LanguageResource;
use PandaZoom\LaravelLanguage\Models\Language;
use PandaZoom\LaravelLanguage\Tasks\UpdateLanguageTask;

class LanguagePatchController extends Controller
{
    public function __invoke(LanguagePatchRequest $request, Language $language, UpdateLanguageTask $task)
    {
        $task->runUpdateOrFail($language, $request->validated());

        return new LanguageResource($language);
    }
}
