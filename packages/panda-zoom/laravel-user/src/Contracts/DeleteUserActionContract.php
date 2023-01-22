<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Contracts;

use PandaZoom\LaravelUser\Models\User;

interface DeleteUserActionContract
{
    /**
     * @param  User  $user
     * @param  bool $permanent
     * @return bool|null
     *
     * @throws \Throwable
     */
    public function run(User $user, bool $permanent = false): ?bool;
}
