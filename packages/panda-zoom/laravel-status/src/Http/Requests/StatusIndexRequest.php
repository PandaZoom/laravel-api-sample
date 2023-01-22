<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Http\Requests;

use PandaZoom\LaravelPaginate\Requests\CursorBasedRequest;
use function trans;

class StatusIndexRequest extends CursorBasedRequest
{
    use HasStatusRule;

    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            ...parent::rules(),
            'user_id' => [
                'sometimes',
                'array',
            ],
            'user_id.*' => [
                'sometimes',
                'integer',
            ],
            'slug' => [
                'sometimes',
                'array',
            ],
            'slug.*' => [
                'sometimes',
                'string',
                'alpha_dash',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'slug' => trans('status::statuses.common.attributes.slug'),
        ];
    }
}
