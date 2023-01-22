<?php
declare(strict_types=1);

namespace PandaZoom\LaravelPassportAuth\Actions;

use Illuminate\Support\Collection;
use PandaZoom\LaravelPassport\Actions\UserAuthByGrantClientAction;
use PandaZoom\LaravelPassportAuth\Contracts\RegisterNewUserActionContract;
use PandaZoom\LaravelUser\Contracts\RegisterUserActionContract;

class RegisterNewUserAction implements RegisterNewUserActionContract
{
    public function __construct(
        protected RegisterUserActionContract $registerUserAction,
        protected UserAuthByGrantClientAction $authByGrantClientAction,
    )
    {
        //
    }

    /**
     * @throws \Throwable
     */
    public function run(Collection $input): array
    {
        $user = $this->registerUserAction->run(
            $input->only(['email', 'password', 'first_name', 'last_name', 'locale', 'timezone', 'theme'])->toArray()
        );

        return $this->authByGrantClientAction->run($user->email, $input->get('password'));
    }
}
