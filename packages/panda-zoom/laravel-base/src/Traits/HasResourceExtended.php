<?php

namespace PandaZoom\LaravelBase\Traits;

use Illuminate\Support\Str;
use function array_filter;
use function array_map;
use function config;
use function explode;
use function in_array;
use function method_exists;

/**
 * @property-read array $availableInclude
 */
trait HasResourceExtended
{
    abstract protected function getResourceData(): array;

    public function toArray($request): array
    {
        $data = $this->filterResourceData($request);

        if (!empty($this->availableInclude)) {
            $this->addIncludes($request, $data);
        }

        return $data;
    }

    public function getAvailableInclude(): array
    {
        return $this->availableInclude;
    }

    protected function addIncludes($request, array &$data): void
    {
        $includeKey = config('common-api.request_key.include');

        if ($request->has($includeKey) && !empty($request->get($includeKey))) {
            $includes = array_map(
                static fn(string $item): string => Str::camel($item),
                explode(',', $request->get($includeKey))
            );

            $includes = array_filter(
                $this->availableInclude,
                static fn(string $include): bool => in_array($include, $includes, true),
            );

            foreach ($includes as $include) {
                $method = 'include'.Str::studly($include);
                if (method_exists(static::class, $method)) {
                    $data[$include] = $this->{$method}();
                }
            }
        }
    }

    protected function filterResourceData($request): array
    {
        $data = $this->getResourceData();

        $filterKey = config('common-api.request_key.filter');

        if ($request->has($filterKey) && !empty($request->get($filterKey))) {
            $filter = array_map(
                static fn(string $item): string => Str::camel($item),
                explode(',', $request->get($filterKey))
            );

            $data = array_filter(
                $data,
                static fn(string $key): bool => in_array($key, $filter, true),
                ARRAY_FILTER_USE_KEY
            );
        }

        return $data;
    }
}
