<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Actions;

use Illuminate\Database\Eloquent\Relations\HasMany;
use PandaZoom\LaravelBase\Exceptions\EmptyIncomeDataException;
use PandaZoom\LaravelBase\Services\RelationByRequest;
use PandaZoom\LaravelUser\Contracts\UpdateUserActionContract;
use PandaZoom\LaravelUser\Models\User;
use function app;
use function throw_if;

class UpdateUserAction implements UpdateUserActionContract
{
    public function run(User $user, array $attributes): bool
    {
        throw_if(
            empty($attributes),
            EmptyIncomeDataException::class
        );

        $isSuccess = $user->updateOrFail($attributes);

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
