<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
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
            'name' => 'required|string|unique:roles,name,'. $this->id,
            'permissions' => 'required|array',
            'id' => 'required|exists:roles,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('customValidation.name.required'),
            'name.unique' => __('customValidation.name.unique'),
            'permissions.required' => __('customValidation.permissions.required'),
        ];
    }
}
