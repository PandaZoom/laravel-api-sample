<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Http\Requests;

use function abs;

trait HasCategoryUpdatePrepare
{
    protected function prepareForValidation(): void
    {
        if ($this->has('active')) {
            $this->merge(['active' => $this->boolean('active')]);
        }

        if ($this->has('position')) {

            $value = $this->integer('position');

            if ($value) {
                $this->merge(['position' => abs($value)]);
            } else {
                $this->request->remove('position');
            }
        }
    }
}
