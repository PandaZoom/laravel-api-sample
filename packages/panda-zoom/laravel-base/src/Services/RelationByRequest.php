<?php

namespace PandaZoom\LaravelBase\Services;

use Illuminate\Database\Eloquent\Builder;
use function array_filter;
use function array_map;
use function array_keys;
use function array_values;
use function config;
use function explode;
use function in_array;
use function is_callable;
use function is_int;
use function is_string;
use function request;

class RelationByRequest
{
    protected array $supportedWith = [];
    protected array $requestedWith = [];

    public function __construct()
    {
        $this->getWithFromRequest();
    }

    public function addSupportedWith(array $supported): static
    {
        $this->supportedWith = $supported;

        return $this;
    }

    public function filterWith(): array
    {
        $output = [];

        if (!empty($this->requestedWith)) {

            $acceptedKeys = $this->filterAcceptedKeys();

            if(!empty($acceptedKeys)){
                $output = $this->getFilteredWithByAcceptedKeys($acceptedKeys);
            }
        }

        return $output;
    }

    public function addBuilder(Builder $builder): Builder
    {
        $with = $this->filterWith();

        if (!empty($with)) {
            $builder->with($with);
        }

        return $builder;
    }

    protected function getFilteredWithByAcceptedKeys(array $acceptedKeys): array
    {
        return array_filter($this->supportedWith, static function (string|callable $value, int|string $key) use ($acceptedKeys): bool {
            $output = false;

            if (is_string($value) && is_int($key)) {
                $output = in_array(
                    $value,
                    $acceptedKeys,
                    true
                );
            } elseif (is_callable($value) && is_string($key)) {
                $output = in_array(
                    $key,
                    $acceptedKeys,
                    true
                );
            }

            return $output;
        }, ARRAY_FILTER_USE_BOTH);
    }

    protected function filterAcceptedKeys(): array
    {
        return array_filter($this->requestedWith, function (string|callable $value, int|string $key): bool {
            $output = false;

            if (is_string($value) && is_int($key)) {
                $output = in_array(
                    $value,
                    $this->getSupportedOnlyKeys(),
                    true
                );
            } elseif (is_callable($value) && is_string($key)) {
                $output = in_array(
                    $key,
                    $this->supportedWith,
                    true
                );
            }

            return $output;
        }, ARRAY_FILTER_USE_BOTH);
    }

    protected function getSupportedOnlyKeys(): array
    {
        return array_map(static fn( int|string $key, mixed $value): string => is_string($key) ? $key : $value, array_keys($this->supportedWith), array_values($this->supportedWith));
    }

    protected function getWithFromRequest(): void
    {
        if (request()?->has(config('common-api.request_key.with'))) {
            $this->requestedWith = explode(',', request()?->get(config('common-api.request_key.with')));
        }
    }
}
