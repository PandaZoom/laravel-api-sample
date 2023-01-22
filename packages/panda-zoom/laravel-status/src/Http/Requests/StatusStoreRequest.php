<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use PandaZoom\LaravelStatus\Models\Status;
use function auth;
use function trans;

class StatusStoreRequest extends FormRequest
{
    use HasStatusRule;

    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $rules = $this->getRules();

        $rules['slug'][] = 'required';
        $rules['slug'][] = Rule::unique(Status::class, 'slug');

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'slug' => trans('status::statuses.common.attributes.slug'),
        ];
    }
}
