<?php
declare(strict_types=1);

namespace PandaZoom\LaravelLanguage\Http\Requests;

trait HasLanguageRules
{
    protected function getRules(): array
    {
        return [
            'locale' => [
                'string',
                'max:10',
            ],
            'name' => [
                'string',
                'max:100',
            ],
            'active' => [
                'boolean',
            ],
        ];
    }
}
