<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Http\Requests;

use Illuminate\Validation\Validator;
use PandaZoom\LaravelBase\Exceptions\EmptyIncomeDataException;
use function throw_if;

class UserPatchRequest extends UserUpdateRequest
{
    public function rules(): array
    {
        $rules = $this->getRules();

        $rules['first_name'][] = 'sometimes';
        $rules['last_name'][] = 'sometimes';
        $rules['active'][] = 'sometimes';
        $rules['theme'][] = 'sometimes';
        $rules['locale'][] = 'sometimes';
        $rules['timezone'][] = 'sometimes';

        return $rules;
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            throw_if(
                $validator->safe()->collect()->isEmpty(),
                EmptyIncomeDataException::class
            );
        });
    }
}
