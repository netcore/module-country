<?php

namespace Modules\Country\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Netcore\Translator\Helpers\TransHelper;

class CountryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->user() && auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'currency_id'  => 'required|exists:netcore_country__currencies,id',
            'code'         => 'required|min:2|max:2',
            'capital'      => 'required|max:255',
            'calling_code' => 'required|digits_between:1,10',
        ];

        foreach (TransHelper::getAllLanguages() as $language) {
            $rules["translations.{$language->iso_code}.name"] = 'required';
            $rules["translations.{$language->iso_code}.full_name"] = 'required';
        }

        return $rules;
    }
}