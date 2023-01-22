<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUser\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use PandaZoom\LaravelEmailRule\Email;
use PandaZoom\LaravelUser\Models\User;
use function trans;

class UserEmailExistRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => [
                ...Email::required(),
                Rule::unique(User::class, 'email'),
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => trans('user::users.common.attributes.email'),
        ];
    }
}
