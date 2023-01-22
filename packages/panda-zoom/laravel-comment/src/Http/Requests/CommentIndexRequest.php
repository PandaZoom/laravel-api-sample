<?php

namespace PandaZoom\LaravelComment\Http\Requests;

use PandaZoom\LaravelPaginate\Requests\CursorBasedRequest;
use function abs;
use function trans;

class CommentIndexRequest extends CursorBasedRequest
{
    use HasCommentRule;

    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            ...parent::rules(),
            'user_id' => [
                'sometimes',
                'integer',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'user_id' => trans('comment::comments.common.attributes.user_id'),
        ];
    }

    public function prepareForValidation(): void
    {
        if ($this->has(['userId'])) {
            $value = abs($this->input('userId')) ?: null;
            if ($value) {
                $this->merge(['user_id' => $value]);
            }
            $this->request->remove('userId');
        }
    }
}
