<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Contracts;

use Illuminate\Support\Collection;
use PandaZoom\LaravelStatus\Models\Status;

interface UpdateStatusActionContract
{
    /**
     * @param Status $status
     * @param \Illuminate\Support\Collection $attributes
     * @return bool
     *
     * @throws \Throwable
     */
    public function run(Status $status, Collection $attributes): bool;
}
