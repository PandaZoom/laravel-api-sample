<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Rules;

use PandaZoom\LaravelCustomRule\BaseCustomRule;
use function abs;

class CategoryName extends BaseCustomRule
{
    /**
     * The minimum size of the first name.
     *
     * @var int|null
     */
    protected ?int $min = 2;

    /**
     * The maximum size of the first name.
     *
     * @var int|null
     */
    protected ?int $max = 255;

    /**
     * Sets the minimum size of the first name.
     *
     * @param int|null $size
     * @return $this
     */
    public function min(?int $size): static
    {
        $this->min = $size;

        return $this;
    }

    /**
     * Sets the minimum size of the first name.
     *
     * @param int|null $size
     * @return $this
     */
    public function max(?int $size): static
    {
        $this->max = abs($size);

        return $this;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $this->resetMessages();

        $rules = ['string'];

        if ($this->min !== null) {
            $rules[] = 'min:' . abs($this->min);
        }

        if ($this->max !== null) {
            $rules[] = 'max:' . abs($this->max);
        }

        $validator = $this->validate($attribute, $rules);

        if ($validator->fails()) {
            return $this->fail($validator->messages()->all());
        }

        return true;
    }
}
