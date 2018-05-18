<?php

namespace Modules\Country\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Netcore\Translator\Helpers\TransHelper;

class CityRequest extends FormRequest
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
            'zip_code' => 'required|min:1|max:15',
        ];

        foreach (TransHelper::getAllLanguages() as $language) {
            $rules["translations.{$language->iso_code}.name"] = 'required';
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        $messages = [];

        foreach (TransHelper::getAllLanguages() as $language) {
            $requiredMessage = "Please provide name in {$language->title_localized} language.";
            $messages["translations.{$language->iso_code}.name.required"] = $requiredMessage;
        }

        return $messages;
    }
}