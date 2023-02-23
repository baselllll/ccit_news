<?php
namespace App\Http\Requests\About;

use Illuminate\Foundation\Http\FormRequest;

class CreateAboutRequest extends FormRequest
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
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|file'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => __('customValidation.title.required'),
            'description.required' => __('customValidation.description.required'),
            'image.required' => __('customValidation.image.required'),
        ];
    }
}
