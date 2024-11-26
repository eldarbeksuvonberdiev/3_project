<?php

namespace App\Http\Requests\UserTask;

use Illuminate\Foundation\Http\FormRequest;

class UserTaskEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'status.required' => 'The status is required.'
        ];
    }
}
