<?php

namespace PandaZoom\LaravelComment\Http\Requests;

/**
 * @mixin \Illuminate\Foundation\Http\FormRequest
 */
trait HasCommentRule
{
    protected function getRules(): array
    {
        return [
            'message' => [
                'string',
                'max:10000',
            ],
        ];
    }
}
