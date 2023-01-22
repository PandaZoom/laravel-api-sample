<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Events;

use Illuminate\Queue\SerializesModels;
use PandaZoom\LaravelUser\Contracts\UserEventContract;
use PandaZoom\LaravelUser\Models\User;

class UserSaved implements UserEventContract
{
    use SerializesModels;

    public function __construct(public User $user)
    {
        //
    }
}
