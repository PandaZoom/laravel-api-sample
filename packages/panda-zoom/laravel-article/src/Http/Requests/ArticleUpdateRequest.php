<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use PandaZoom\LaravelUserLocale\Rules\LocaleRule;
use function array_merge;
use function auth;
use function config;
use function trans;

class ArticleUpdateRequest extends FormRequest
{
    use HasArticleRule;
    use HasArticlePrepareForValidation;

    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $rules = $this->getRules();

        $rules['status_id'][] = 'required';
        $rules['published_at'][] = 'nullable';
        $rules['expires_at'][] = 'nullable';
        $rules['category_id'][] = 'required';
        $rules['category_id.*'][] = 'required';
        $rules['translations'][] = 'required';

        return array_merge($rules, [
            'translations.'.config('app.fallback_locale').'.locale' => LocaleRule::required(),
            'translations.'.config('app.fallback_locale').'.title' => [
                'required',
                'string',
                'max:150',
            ],
            'translations.'.config('app.fallback_locale').'.name' => [
                'required',
                'string',
                'max:255',
            ],

            'translations.*.locale' => (new LocaleRule())->requiredWith('translations.*.name'),
            'translations.*.title' => [
                'required_with:translations.*.locale,translations.*.name',
                'string',
                'max:150',
            ],
            'translations.*.description' => [
                'nullable',
                'string',
                'max:255',
            ],
            'translations.*.name' => [
                'required_with:translations.*.locale,translations.*.title',
                'string',
                'max:255',
            ],
            'translations.*.summary' => [
                'nullable',
                'string',
                'max:3000',
            ],
            'translations.*.story' => [
                'nullable',
                'string',
            ],
        ]);
    }

    public function attributes(): array
    {
        return [
            'status_id' => trans('article::articles.common.attributes.status_id'),
            'published_at' => trans('article::articles.common.attributes.published_at'),
            'expires_at' => trans('article::articles.common.attributes.expires_at'),
            'translations' => trans('article::articles.common.attributes.translations'),
            'translations.*.title' => trans('article::articles.common.attributes.title'),
            'translations.*.description' => trans('article::articles.common.attributes.description'),
            'translations.*.name' => trans('article::articles.common.attributes.name'),
            'translations.*.summary' => trans('article::articles.common.attributes.summary'),
            'translations.*.story' => trans('article::articles.common.attributes.story'),
        ];
    }
}
