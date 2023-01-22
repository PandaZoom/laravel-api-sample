<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Contracts;

use PandaZoom\LaravelUser\Models\User;

interface RestoreUserActionContract
{
    /**
     * @param  User  $user
     * @return bool|null
     *
     * @throws \Throwable
     */
    public function run(User $user): ?bool;
}
