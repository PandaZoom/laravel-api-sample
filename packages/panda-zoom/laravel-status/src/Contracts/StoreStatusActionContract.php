<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Contracts;

use Illuminate\Support\Collection;
use PandaZoom\LaravelStatus\Models\Status;

interface StoreStatusActionContract
{
    public function run(Collection $attributes): Status;
}
