<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Rules;

use function abs;
use function config;
use PandaZoom\LaravelCustomRule\BaseCustomRule;

class LastNameRule extends BaseCustomRule
{
    /**
     * The minimum size of the last name.
     *
     * @var int|null
     */
    protected ?int $min = 2;

    /**
     * The maximum size of the last name.
     *
     * @var int|null
     */
    protected ?int $max = 100;

    public function __construct()
    {
        if(config('common-api.rules.last_name.min')){
            $this->min = config('common-api.rules.last_name.min');
        }

        if(config('common-api.rules.last_name.max')){
            $this->max = config('common-api.rules.last_name.max');
        }
    }

    /**
     * Sets the minimum size of the first name.
     *
     * @param  int|null  $size
     * @return static
     */
    public function min(?int $size): static
    {
        $this->min = $size;

        return $this;
    }

    /**
     * Sets the minimum size of the first name.
     *
     * @param  int|null  $size
     * @return static
     */
    public function max(?int $size): static
    {
        $this->max = $size;

        return $this;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $this->resetMessages();

        $rules = ['string'];

        if ($this->min !== null) {
            $rules[] = 'min:'.abs($this->min);
        }

        if ($this->max !== null) {
            $rules[] = 'max:'.abs($this->max);
        }

        $validator = $this->validate($attribute, $rules);

        if ($validator->fails()) {
            return $this->fail($validator->messages()->all());
        }

        return true;
    }
}
