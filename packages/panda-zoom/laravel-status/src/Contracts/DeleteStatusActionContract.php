<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Contracts;

use PandaZoom\LaravelStatus\Models\Status;

interface DeleteStatusActionContract
{
    /**
     * @param  Status  $status
     * @param  bool $permanent
     * @return bool|null
     *
     * @throws \Throwable
     */
    public function run(Status $status, bool $permanent = false): ?bool;
}
