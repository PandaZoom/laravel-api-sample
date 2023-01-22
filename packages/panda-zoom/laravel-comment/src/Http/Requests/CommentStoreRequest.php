<?php

namespace PandaZoom\LaravelComment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use function auth;
use function trans;

class CommentStoreRequest extends FormRequest
{
    use HasCommentRule;

    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $rules = $this->getRules();

        $rules['message'][] = 'required';

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'message' => trans('comment::comments.common.attributes.message'),
        ];
    }
}
