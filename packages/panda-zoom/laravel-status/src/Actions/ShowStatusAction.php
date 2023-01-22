<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Actions;

use PandaZoom\LaravelStatus\Contracts\ShowStatusActionContract;
use PandaZoom\LaravelStatus\Models\Status;
use function app;

class ShowStatusAction implements ShowStatusActionContract
{
    public function run(Status $status): void
    {
        $with = app(StatusSupportRelationAction::class)->run();

        if (!empty($with)) {
            $status->load($with);
        }
    }
}
