<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use PandaZoom\LaravelCategory\Rules\CategoryName;
use function trans;

class CategoryIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'active' => [
                'sometimes',
                'boolean'
            ],
            'name' => CategoryName::sometimes(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function attributes(): array
    {
        return [
            'active' => trans('category::categories.common.attributes.active'),
            'name' => trans('category::categories.common.attributes.name'),
        ];
    }

    /**
     * @inheritDoc
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('active')) {
            $this->merge(['active' => $this->boolean('active')]);
        }
    }
}
