<?php
declare(strict_types=1);

namespace PandaZoom\LaravelPaginate\Requests;

use Illuminate\Foundation\Http\FormRequest;
use function abs;
use function trans;

abstract class CursorBasedRequest extends FormRequest
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
            'cursor' => ['sometimes', 'alpha_num'],
            'limit' => ['sometimes', 'integer'],
        ];
    }

    /**
     * @inheritDoc
     */
    public function attributes(): array
    {
        return [
            'cursor' => trans('paginate::request.attributes.cursor'),
            'limit' => trans('paginate::request.attributes.limit'),
        ];
    }

    /**
     * @inheritDoc
     */
    public function prepareForValidation(): void
    {
        if ($this->request->has('cursor')) {
            $value = $this->request->getAlnum('cursor');

            if (! empty($value)) {
                $this->merge(['cursor' => $value]);
            } else {
                $this->request->remove('cursor');
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
