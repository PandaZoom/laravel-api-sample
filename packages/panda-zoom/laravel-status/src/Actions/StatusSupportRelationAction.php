<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Actions;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use PandaZoom\LaravelBase\Services\RelationByRequest;
use function app;

class StatusSupportRelationAction
{
    public function run(): array
    {
        return app(RelationByRequest::class)
            ->addSupportedWith([
                'user',
                'article' => static fn(BelongsToMany $q) => $q->withTranslation(),
                'articles' => static fn(BelongsToMany $q) => $q->withTranslation(),
            ])
            ->filterWith();
    }
}
