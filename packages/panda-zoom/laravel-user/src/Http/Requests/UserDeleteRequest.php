<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Http\Requests;

class UserDeleteRequest extends UserUpdateRequest
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
}
