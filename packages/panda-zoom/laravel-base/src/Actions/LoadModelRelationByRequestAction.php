<?php
declare(strict_types=1);

namespace PandaZoom\LaravelBase\Actions;

use Illuminate\Database\Eloquent\Model;
use PandaZoom\LaravelBase\Services\RelationByRequest;
use function app;

class LoadModelRelationByRequestAction
{
    public function run(Model $model, array $supportedRelation): Model
    {
        $with = app(RelationByRequest::class)
            ->addSupportedWith($supportedRelation)
            ->filterWith();

        if (!empty($with)) {
            $model->load($with);
        }

        return $model;
    }
}
