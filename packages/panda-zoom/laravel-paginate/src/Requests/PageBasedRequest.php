<?php
declare(strict_types=1);

namespace PandaZoom\LaravelPaginate\Requests;

use Illuminate\Foundation\Http\FormRequest;
use function abs;
use function trans;

abstract class PageBasedRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'page' => ['sometimes', 'integer'],
            'limit' => ['sometimes', 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributes(): array
    {
        return [
            'page' => trans('paginate::request.attributes.page'),
            'limit' => trans('paginate::request.attributes.limit'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function prepareForValidation(): void
    {
        if ($this->request->has('page')) {
            $value = abs($this->request->getInt('page'));

            if ($value) {
                $this->merge(['page' => $value]);
            } else {
                $this->request->remove('page');
            }
        }

        if ($this->request->has('limit')) {
            $value = abs($this->request->getInt('limit'));

            if ($value) {
                $this->merge(['limit' => $value]);
            } else {
                $this->request->remove('limit');
            }
        }
    }
}
