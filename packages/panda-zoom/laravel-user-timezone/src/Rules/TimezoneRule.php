<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUserTimezone\Rules;

use Illuminate\Support\Facades\Validator;
use PandaZoom\LaravelCustomRule\BaseCustomRule;

class TimezoneRule extends BaseCustomRule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $this->messages = [];

        $validator = Validator::make(
            $this->data,
            [$attribute => ['string', 'timezone', ...$this->customRules]],
            $this->validator->customMessages,
            $this->validator->customAttributes
        );

        if ($validator->fails()) {
            return $this->fail($validator->messages()->all());
        }

        return true;
    }
}
