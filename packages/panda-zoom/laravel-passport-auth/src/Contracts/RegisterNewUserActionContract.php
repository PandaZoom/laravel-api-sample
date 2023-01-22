<?php
declare(strict_types=1);

namespace PandaZoom\LaravelPassportAuth\Contracts;

use Illuminate\Support\Collection;

interface RegisterNewUserActionContract
{
    /**
     * @param  Collection  $input
     * @return array
     *
     * @throws \Throwable
     */
    public function run(Collection $input): array;
}
