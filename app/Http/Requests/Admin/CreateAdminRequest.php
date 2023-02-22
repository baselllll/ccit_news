<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdminRequest extends FormRequest
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
            'full_name' => 'required',
            'email' => 'required|string|unique:admins,email',
            'phone' => 'required',
            'email_address' => 'required|email|unique:admins,email_address',
            'password' => 'required',
            'roles' => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => __('customValidation.full_name.required'),
            'email.required' => __('customValidation.username.required'),
            'email.unique' => __('customValidation.username.unique'),
            'phone.required' => __('customValidation.phone.required'),
            'email_address.required' => __('customValidation.email.required'),
            'email_address.email' => __('customValidation.email.email'),
            'email_address.unique' => __('customValidation.email.unique'),
            'password.required' => __('customValidation.password.required'),
            'roles.required' => __('customValidation.roles.required'),
        ];
    }
}
