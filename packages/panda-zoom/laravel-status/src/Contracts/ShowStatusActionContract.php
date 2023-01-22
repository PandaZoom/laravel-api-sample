<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Contracts;

use PandaZoom\LaravelArticle\Models\Article;
use PandaZoom\LaravelStatus\Models\Status;

interface ShowStatusActionContract
{
    public function run(Status $status): void;
}
