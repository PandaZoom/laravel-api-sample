<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use PandaZoom\LaravelUserLocale\Rules\LocaleRule;
use function auth;
use function trans;

class CategoryStoreRequest extends FormRequest
{
    use HasCategoryRules;
    use HasCategoryUpdatePrepare;

    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $rules = $this->getRules();

        $rules['active'][] = 'required';
        $rules['position'][] = 'sometimes';

        $rules['translations'][] = 'required';

        return array_merge($rules, [
            'translations.'.config('app.fallback_locale').'.locale' => (new LocaleRule())->requiredWith('translations.'.config('app.fallback_locale').'.name'),
            'translations.'.config('app.fallback_locale').'.name' => [
                'required_with:translations.'.config('app.fallback_locale').'.locale',
                'string',
                'max:255',
            ],

            'translations.*.locale' => (new LocaleRule())->requiredWith('translations.*.name'),
            'translations.*.name' => [
                'required_with:translations.*.locale',
                'string',
                'max:255',
            ],
        ]);
    }

    /**
     * @inheritDoc
     */
    public function attributes(): array
    {
        return [
            'active' => trans('category::categories.common.attributes.active'),
            'position' => trans('category::categories.common.attributes.position'),
            'name' => trans('category::categories.common.attributes.name'),
            'translations' => trans('category::categories.common.attributes.translations'),
            'translations.*.locale' => trans('category::categories.common.attributes.locale'),
            'translations.*.name' => trans('category::categories.common.attributes.name'),
        ];
    }
}
