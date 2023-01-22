<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Http\Requests;

use PandaZoom\LaravelPaginate\Requests\CursorBasedRequest;
use PandaZoom\LaravelUser\Rules\FirstNameRule;
use PandaZoom\LaravelUser\Rules\LastNameRule;
use PandaZoom\LaravelUserLocale\Rules\LocaleRule;
use PandaZoom\LaravelUserTimezone\Rules\TimezoneRule;
use function trans;

class UserIndexRequest extends CursorBasedRequest
{
    use HasUserRequestPrepare;

    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            ...parent::rules(),
            'first_name' => FirstNameRule::sometimes(),
            'last_name' => LastNameRule::sometimes(),
            'active' => [
                'sometimes',
                'boolean',
            ],
            'timezone' => TimezoneRule::sometimes(),
            'locale' => LocaleRule::sometimes(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function attributes(): array
    {
        return [
            ...parent::attributes(),
            'first_name' => trans('user::users.common.attributes.first_name'),
            'last_name' => trans('user::users.common.attributes.last_name'),
            'active' => trans('user::users.common.attributes.active'),
            'locale' => trans('user::users.common.attributes.locale'),
            'timezone' => trans('user::users.common.attributes.timezone'),
        ];
    }
}
