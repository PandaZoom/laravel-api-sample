<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Actions;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use PandaZoom\LaravelBase\Services\RelationByRequest;
use PandaZoom\LaravelUser\Contracts\RestoreUserActionContract;
use PandaZoom\LaravelUser\Exceptions\UserNotRestoredException;
use PandaZoom\LaravelUser\Models\User;
use function app;
use function throw_if;

class RestoreUserAction implements RestoreUserActionContract
{
    /**
     * @inheritDoc
     */
    public function run(User $user): ?bool
    {
        $isSuccess = $user->restore();

        throw_if(
            !$isSuccess,
            UserNotRestoredException::class
        );

        $with = app(RelationByRequest::class)
            ->addSupportedWith([
                'language',
                'articles' => static fn(HasMany $q) => $q->withTranslation(),
                'article' => static fn(HasMany $q) => $q->withTranslation(),
            ])
            ->filterWith();

        if (!empty($with)) {
            $user->load($with);
        }

        return $isSuccess;
    }
}
