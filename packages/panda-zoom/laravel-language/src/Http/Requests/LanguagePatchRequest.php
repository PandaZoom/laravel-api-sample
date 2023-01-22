<?php
declare(strict_types=1);

namespace PandaZoom\LaravelLanguage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use function explode;
use function trans;

class LanguagePatchRequest extends FormRequest
{
    use HasLanguageRules;

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        $rules = $this->getRules();

        $rules['locale'][] = 'sometimes';
        $rules['name'][] = 'sometimes';
        $rules['active'][] = 'sometimes';

        return $rules;
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'locale' => trans('language::languages.common.attributes.locale'),
            'name' => trans('language::languages.common.attributes.name'),
            'active' => trans('language::languages.common.attributes.active'),
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('active')) {
            $this->merge(['active' => $this->boolean('active')]);
        }

        if ($this->has('locale')) {

            $this->merge(['locale' => (string)Str::of($this->input('locale'))
                ->slug()
                ->whenContains(['-'], function (string $str): string {
                    $value = explode('-', $str);
                    return Str::of($value[0])->lower()->toString() . '-' . Str::of($value[1])->upper()->toString();
                })]);
        }
    }
}
