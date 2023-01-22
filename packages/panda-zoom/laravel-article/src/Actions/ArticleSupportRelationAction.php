<?php

namespace PandaZoom\LaravelArticle\Actions;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use PandaZoom\LaravelBase\Services\RelationByRequest;

class ArticleSupportRelationAction
{
    public function run(): array
    {
        return app(RelationByRequest::class)
            ->addSupportedWith([
                'translations', '
                translation',
                'user',
                'status',
                'comments',
                'categories' => static fn(BelongsToMany $q) => $q->withTranslation()
            ])
            ->filterWith();
    }
}
