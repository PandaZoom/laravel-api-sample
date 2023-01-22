<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use PandaZoom\LaravelCategory\Models\Category;
use PandaZoom\LaravelUser\Models\User;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use function trans;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can manage the resource like Admin.
     *
     * @param User $user
     * @param string $ability
     * @return bool|null
     */
    public function before(User $user, string $ability): ?bool
    {
        return $user->hasAdminRole() ? true : null;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param \PandaZoom\LaravelUser\Models\User|null $user
     * @return \Illuminate\Auth\Access\Response
     */
    public function viewAny(?User $user): Response
    {
        return Response::allow(code: SymfonyResponse::HTTP_OK);
    }

    /**
     * Determine whether the user can create resources.
     *
     * @param User|null $user
     * @return Response
     */
    public function create(?User $user): Response
    {
        return $user instanceof User && $user->hasAdminRole()
            ? Response::allow(code: SymfonyResponse::HTTP_CREATED)
            : Response::deny(trans('category::categories.common.messages.error_403_create'), SymfonyResponse::HTTP_FORBIDDEN);
    }

    /**
     * Determine whether the user can view the resource.
     *
     * @param User|null $user
     * @param Category $resource
     * @return Response
     */
    public function view(?User $user, Category $resource): Response
    {
        return $resource->active
            ? Response::allow(code: SymfonyResponse::HTTP_OK)
            : Response::deny(trans('category::categories.common.messages.error_403_deactivated'), SymfonyResponse::HTTP_FORBIDDEN);
    }

    /**
     * Determine whether the user can update the resource.
     *
     * @param User $user
     * @param Category $resource
     * @return Response
     */
    public function update(User $user, Category $resource): Response
    {
        return $user->hasAdminRole()
            ? Response::allow(code: SymfonyResponse::HTTP_OK)
            : Response::deny(trans('category::categories.common.messages.error_403_update', [
                'id' => $resource->getKey()
            ]), SymfonyResponse::HTTP_FORBIDDEN);
    }

    /**
     * Determine whether the user can delete the resource.
     *
     * @param User $user
     * @param Category $resource
     * @return Response
     */
    public function delete(User $user, Category $resource): Response
    {
        return $user->hasAdminRole()
            ? Response::allow(code: SymfonyResponse::HTTP_NO_CONTENT)
            : Response::deny(trans('category::categories.common.messages.error_403_delete', [
                'id' => $resource->getKey()
            ]), SymfonyResponse::HTTP_FORBIDDEN);
    }
}
