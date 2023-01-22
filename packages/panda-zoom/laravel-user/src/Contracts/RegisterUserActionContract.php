<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Contracts;

use PandaZoom\LaravelUser\Models\User;

interface RegisterUserActionContract
{
    /**
     * @param  array  $attributes
     * @return User
     *
     * @throws \Throwable
     */
    public function run(array $attributes): User;
}
