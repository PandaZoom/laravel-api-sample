<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use PandaZoom\LaravelUser\Models\User;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use function trans;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can manage the resource like Admin.
     *
     * @param  User  $user
     * @param  string  $ability
     * @return bool|null
     */
    public function before(User $user, string $ability): ?bool
    {
        return $user->hasAdminRole() ? true : null;
    }

    /**
     * Determine whether the user can create resources.
     *
     * @param  User|null  $user
     * @return Response
     */
    public function create(?User $user): Response
    {
        if (! ($user instanceof User)) {
            $output = Response::deny(trans('user::users.common.messages.error_401_create'), SymfonyResponse::HTTP_UNAUTHORIZED);
        } elseif (! $user->active) {
            $output = Response::deny(trans('user::users.common.messages.error_403_create_user_deactivated'), SymfonyResponse::HTTP_FORBIDDEN);
        } else {
            $output = Response::allow(trans('base::response.store.messages.success'), SymfonyResponse::HTTP_CREATED);
        }

        return $output;
    }

    /**
     * Determine whether the user can view the resource.
     *
     * @param  User|null  $user
     * @param  User  $resource
     * @return Response
     */
    public function view(?User $user, User $resource): Response
    {
        return $resource->active
            ? Response::allow(code: SymfonyResponse::HTTP_OK)
            : Response::deny(trans('user::users.common.messages.error_403_user_deactivated', [
                'id' => $resource->getAuthIdentifier(),
            ]), SymfonyResponse::HTTP_FORBIDDEN);
    }

    /**
     * Determine whether the user can update the resource.
     *
     * @param  User  $user
     * @param  User  $resource
     * @return Response
     */
    public function update(User $user, User $resource): Response
    {
        return $user->getAuthIdentifier() === $resource->getAuthIdentifier()
            ? Response::allow(trans('base::response.update.messages.success'), SymfonyResponse::HTTP_OK)
            : Response::deny(
                trans('user::users.common.messages.error_403_update', [
                    'id' => $resource->getAuthIdentifier(),
                ]),
                SymfonyResponse::HTTP_FORBIDDEN
            );
    }

    /**
     * Determine whether the user can delete the resource.
     *
     * @param  User  $user
     * @param  User  $resource
     * @return Response
     */
    public function delete(User $user, User $resource): Response
    {
        return $user->getAuthIdentifier() === $resource->getAuthIdentifier()
            ? Response::allow(trans('base::response.destroy.messages.success'), SymfonyResponse::HTTP_NO_CONTENT)
            : Response::deny(trans('user::users.common.messages.error_403_delete', [
                'id' => $resource->getAuthIdentifier(),
            ]), SymfonyResponse::HTTP_FORBIDDEN);
    }
}
