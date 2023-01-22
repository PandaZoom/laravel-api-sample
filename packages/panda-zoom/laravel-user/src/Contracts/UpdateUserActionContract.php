<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Contracts;

use PandaZoom\LaravelUser\Models\User;

interface UpdateUserActionContract
{
    /**
     * @param  User  $user
     * @param  array  $attributes
     * @return bool
     *
     * @throws \Throwable
     */
    public function run(User $user, array $attributes): bool;
}
