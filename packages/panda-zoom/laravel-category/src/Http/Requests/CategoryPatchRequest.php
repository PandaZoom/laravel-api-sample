<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Http\Requests;

use PandaZoom\LaravelUserLocale\Rules\LocaleRule;
use function array_merge;
use function config;

class CategoryPatchRequest extends CategoryStoreRequest
{
    use HasCategoryRules;
    use HasCategoryUpdatePrepare;

    public function rules(): array
    {
        $rules = $this->getRules();

        $rules['active'][] = 'sometimes';
        $rules['position'][] = 'sometimes';

        if($this->has('translations')){

            $rules['translations'][] = 'sometimes';

            $rules = array_merge($rules, [
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

        return $rules;
    }
}
