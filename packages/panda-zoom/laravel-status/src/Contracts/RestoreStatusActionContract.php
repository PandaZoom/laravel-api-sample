<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Contracts;

use PandaZoom\LaravelStatus\Models\Status;

interface RestoreStatusActionContract
{
    /**
     * @param Status $status
     * @return bool|null
     *
     * @throws \Throwable
     */
    public function run(Status $status): ?bool;
}
