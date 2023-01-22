<?php
declare(strict_types=1);

namespace PandaZoom\LaravelStatus\Http\Requests;

trait HasStatusRule
{
    protected function getRules(): array
    {
        return [
            'slug' => [
                'string',
                'alpha_dash',
                'min:3',
                'max:30',
            ],
        ];
    }

    public function prepareForValidation(): void
    {
        if ($this->has('slug')) {
            $this->merge(['slug' => $this->string('slug')?->slug('-')->toString()]);
        }
    }
}
