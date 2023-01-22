<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Http\Requests;

trait HasCategoryRules
{
    protected function getRules(): array
    {
        $rules = [
            'active' => [
                'boolean'
            ],
            'position' => [
                'integer',
                'min:0'
            ],
        ];

        $rules['translations'] = [
            'array',
            'min:1',
        ];

        return $rules;
    }
}
