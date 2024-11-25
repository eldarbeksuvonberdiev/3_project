<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
            'confirm_password' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email is not type of email',
            'email.unique' => 'Email is already exists',
            'password.required' => 'Password is required',
            'password.min' => 'Password length is at least 5 symbols',
            'confirm_password.required' => 'Password confirmation is required',
            'confirm_password.same' => 'Password confirmation does not match',
        ];
    }
}
