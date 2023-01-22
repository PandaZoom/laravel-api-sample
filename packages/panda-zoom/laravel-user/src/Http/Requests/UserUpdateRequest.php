<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use PandaZoom\LaravelUser\Rules\FirstNameRule;
use PandaZoom\LaravelUser\Rules\LastNameRule;
use PandaZoom\LaravelUserLocale\Rules\LocaleRule;
use PandaZoom\LaravelUserTimezone\Rules\TimezoneRule;
use function auth;
use function trans;

class UserUpdateRequest extends FormRequest
{
    use HasUserRequestPrepare;

    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $rules = $this->getRules();

        $rules['first_name'][] = 'required';
        $rules['last_name'][] = 'nullable';
        $rules['active'][] = 'nullable';
        $rules['locale'][] = 'nullable';
        $rules['timezone'][] = 'nullable';

        return $rules;
    }

    /**
     * @inheritDoc
     */
    public function attributes(): array
    {
        return [
            'first_name' => trans('user::users.common.attributes.first_name'),
            'last_name' => trans('user::users.common.attributes.last_name'),
            'active' => trans('user::users.common.attributes.active'),
            'locale' => trans('user::users.common.attributes.locale'),
            'timezone' => trans('user::users.common.attributes.timezone'),
        ];
    }

    protected function getRules(): array
    {
        return [
            'first_name' => FirstNameRule::toArray(),
            'last_name' => LastNameRule::toArray(),
            'active' => [
                'boolean',
            ],
            'locale' => LocaleRule::toArray(),
            'timezone' => TimezoneRule::toArray(),
        ];
    }
}
