<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            "title"=>"required",
            "content"=>"",
            "type"=>"required",
            "image_link"=>"required",
            "video_link"=>"required",
        ];
    }

    public function messages()
    {
        return [
            'title.required' => __('customValidation.title.required'),
            'content.required' => __('customValidation.content.required'),
            'type.required' => __('customValidation.type.required'),
            'image_link.required' => __('customValidation.image_link.required'),
            'video_link.required' => __('customValidation.video_link.required')
        ];
    }
}
