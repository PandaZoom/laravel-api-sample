<?php
declare(strict_types=1);

namespace PandaZoom\LaravelPassportAuth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use PandaZoom\LaravelEmailRule\Email;
use PandaZoom\LaravelUser\Models\User;
use PandaZoom\LaravelUser\Rules\FirstNameRule;
use PandaZoom\LaravelUser\Rules\LastNameRule;
use PandaZoom\LaravelUserLocale\Rules\LocaleRule;
use PandaZoom\LaravelUserTimezone\Rules\TimezoneRule;
use function auth;
use function config;
use function trans;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->guest();
    }

    public function rules(): array
    {
        return [
            'email' => [
                ...Email::required(),
                Rule::unique(User::class, 'email'),
            ],
            'password' => Password::min(config('common-api.rules.password.min'))
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
                ->required(),
            'first_name' => FirstNameRule::required(),
            'last_name' => LastNameRule::nullable(),
            'locale' => LocaleRule::nullable(),
            'timezone' => TimezoneRule::nullable(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function attributes(): array
    {
        return [
            'first_name' => trans('user::users.common.attributes.first_name'),
            'last_name' => trans('user::users.common.attributes.last_name'),
            'email' => trans('user::users.common.attributes.email'),
            'password' => trans('user::users.common.attributes.password'),
        ];
    }

    public function prepareForValidation(): void
    {
        $merge = [
            'first_name' => $this->request->get('firstName'),
        ];
        $this->request->remove('firstName');

        if ($this->has('lastName')) {
            $merge['last_name'] = $this->request->get('lastName');
            $this->request->remove('lastName');
        }

        $this->merge($merge);
    }
}
