<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'maxDiscount' => 'required',
            'VAT' => 'required',
            'logo' => 'sometimes|mimes:jpeg,jpg,png,gif|required|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'maxDiscount.required' => __('customValidation.maxDiscount.required'),
            'VAT.required' => __('customValidation.VAT.required'),
        ];
    }
}
