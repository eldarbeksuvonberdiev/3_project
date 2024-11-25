<?php

namespace App\Http\Requests\Answer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AnswerStoreRequest extends FormRequest
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
            'comment' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'comment.required' => 'This field is required',
            'comment.max' => 'Max length is 255 symbols'
        ];
    }
}
