<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Http\Requests;

/**
 * @mixin \Illuminate\Foundation\Http\FormRequest
 */
trait HasUserRequestPrepare
{
    /**
     * @inheritDoc
     */
    public function prepareForValidation(): void
    {
        if ($this->has('active')) {
            $this->merge(['active' => $this->boolean('active')]);
        }

        if ($this->request->has('locale')) {

            $value = $this->request->getAlnum('locale');

            if (! empty($value)) {
                $this->merge(['locale' => $value]);
            } else {
                $this->request->remove('locale');
            }
        }
    }
}
