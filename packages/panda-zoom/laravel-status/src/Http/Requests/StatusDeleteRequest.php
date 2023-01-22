<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use function auth;
use function trans;

class StatusDeleteRequest extends FormRequest
{
    use HasStatusRule;

    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'permanent' => [
                'nullable',
                'boolean',
            ]
        ];
    }

    public function attributes(): array
    {
        return [
            'permanent' => trans('status::statuses.delete.attributes.permanent'),
        ];
    }
}
